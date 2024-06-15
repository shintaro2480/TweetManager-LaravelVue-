<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaController extends Controller
{
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
        //ユーザーがアップロードしたファイルを指定されたディレクトリ（uploads）に保存し、そのファイルのパスを変数（$filePath）に格納
        $filePath = $request->file('file')->store('uploads', 'public');

        //アップロードした画像の名前とともに、大量代入でデータベース登録
        Media::create([
            'name' => $request->name,
            'type' => $request->type,
            'file' => $filePath,
            'tag_id' => $request->tag_id,
        ]);


        // サムネイルの生成と保存
        // 希望するドライバーで新しいマネージャー インスタンスを作成する
        $manager = new ImageManager(new Driver());
        /*
        $thumbnailImage = Image::make($filePath)->resize(150, 150);
        $thumbnailPath = storage_path('app/public/thumbnails/' . $filePath);
        $thumbnailImage->save($thumbnailPath);
        */

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
