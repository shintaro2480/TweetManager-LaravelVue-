<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//アップロードした画像から小サムネイルを取得するためのライブラリ
use Intervention\Image\ImageManager;
//Dockerで用意したGDドライバーの読み込み
use Intervention\Image\Drivers\Gd\Driver;

class MediaController extends Controller
{
    protected $imageManager;


    //全ての投稿を表示させる
    public function index()
    {
        $media = Media::with('tag')->get();
        return view('media.index', compact('media'));
    }
    
    //メディアを新規投稿する
    public function create()
    {
        $tags = Tag::all();
        return view('media.create', compact('tags'));
    }

    public function store(Request $request)
    {
        //バリデート
        /*
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt|max:20000',
            'tag' => 'required|array'
        ]);
        */

        $image = request()->file('image');
//        request()->file('image')->move('storage/images', $name);
//        $post->image = $name;

        // アップロードされたファイルを取得し、それを$imageに代入。この変数は、Illuminate\Http\UploadedFileオブジェクトの型となっており、
        //この型からはファイル名、ファイルサイズ等情報の取得や、ファイルの移動・保存メソッドを実行できる
        $imageName = request()->file('file')->getClientOriginalName();

        //ユーザーがアップロードしたファイルを指定されたディレクトリ（uploads）に保存し、そのファイルのパスを変数（$filePath）に格納
        //$filePathには、"uploads/example.txt"という文字列が保存されている
//        $filePath = $request->file('file')->store('uploads', 'public');
$name = date('Ymd_His').'_'.$imageName;
$cat = request()->file('file')->move('storage/uploads/', $name);
//            $post->image = $name;

//        $filePath = date('Ymd_His').'_'.$filePath;

        // オリジナル画像のファイル名を生成
        $originalName = date('Ymd_His') . $imageName;
        // サムネイル画像のファイル名を生成
        $thumbnailName = '_thumb.' . date('Ymd_His') .  $imageName;

        //アップロードした画像の名前とともに、大量代入でデータベース登録
        Media::create([
            'name' => $name,
            'type' => $request->type,
            'file' => $thumbnailName,
            'tag_id' => $request->tag_id,
        ]);

        //DriverからImageManagerインスタンスを生成
        $manager = new ImageManager(new Driver());
        //$image(フォームから送られた画像)を読み込む
//        $load = $request->file('file');
        $image = $manager->read($cat);

        // scale to fixed height
        $image->scale(width: 300);
        $saveThumbnailPath = 'storage/thumbnail/' . $thumbnailName;

//        $image->save('storage/uploads/', $thumbnailName);
        $image->save($saveThumbnailPath);
//        $image->save(storage_path('app/public/uploads/hoge-flip223.png'));
//        $image->save(storage_path($saveThumbnailPath));

        return redirect()->route('media.index')->with('success', 'Media uploaded successfully.');
    }

    public function show(Media $media)
    {
        return view('media.show', compact('media'));
    }

    public function edit(Media $media)
    {
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt|max:20000',
            'tag' => 'required|array'
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $media->file = $filePath;
        }

        $media->name = $request->name;
        $media->type = $request->type;
        $media->tag = json_encode($request->tag);
        $media->save();

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
