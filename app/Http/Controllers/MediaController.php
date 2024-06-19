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
        $media = Media::all();
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
        /*
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt|max:20000',
            'tag' => 'required|array'
        ]);
        */

        // アップロードされたファイルを取得し、それを$imageに代入。この変数は、Illuminate\Http\UploadedFileオブジェクトの型となっており、
        //この型からはファイル名、ファイルサイズ等情報の取得や、ファイルの移動・保存メソッドを実行できる
        $image = $request->file('file');

        //ユーザーがアップロードしたファイルを指定されたディレクトリ（uploads）に保存し、そのファイルのパスを変数（$filePath）に格納
        $filePath = $request->file('file')->store('uploads', 'public');

        // サムネイル画像のファイル名を生成
        $thumbnailName = time() . '_thumb.' . $image->getClientOriginalExtension();

        //アップロードした画像の名前とともに、大量代入でデータベース登録
        Media::create([
            'name' => $request->name,
            'type' => $request->type,
            'file' => $filePath,
            'tag_id' => $request->tag_id,
        ]);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($image);

// scale to fixed height
$image->scale(height: 300); // 400 x 300

// scale to 200 x 100 pixel
$image->scale(200, 100); // 200 x 150

$image->save(storage_path('app/public/hoge-flip222.png'));

//Storage::disk('public')->put($thumbnailName, $image);

//$image->store('uploads', 'public');

/*

        $thumbnail = $this->manager->make($image)
        ->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->stream();

*/

//        $thumbnailfilePath = $thumbnail->store('uploads', 'public');

        /*
    Storage::disk('public')->put($thumbnailName, $thumbnail);
*/

        // サムネイルの生成と保存
        // 希望するドライバーで新しいマネージャー インスタンスを作成する
        //$manager = new ImageManager(new Driver());
        /*
        $thumbnailImage = Image::make($filePath)->resize(150, 150);
        $thumbnailPath = storage_path('app/public/thumbnails/' . $filePath);
        $thumbnailImage->save($thumbnailPath);
        */

        //$image = ImageManager::imagick()->read('images/example.jpg');

// resize to 300 x 200 pixel
//$image->resize(300, 200);

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
