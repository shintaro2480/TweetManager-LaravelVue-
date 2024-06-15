<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag; // Tagモデルのインポート

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::all();
        return view('tag.index', compact('tags'));
    }

    /*
    public function create()
    {
        return view('tag.create');
    }
*/
    public function store(Request $request)
    {
        // バリデーションや保存処理を行う
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
    }
/*
    public function show(Tag $tag)
    {
        return view('tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        // バリデーションや更新処理を行う
    }
*/

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tag.index')->with('success', 'Tag deleted successfully.');
    }

}

