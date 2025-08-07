<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage; // ←★これを追加！

class PostController extends Controller
{
    // 一覧ページ
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'asc')->get(); // 昇順（古い順）


        return view('posts.index', compact('posts'));
    }

    // 詳細ページ
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 作成ページ
    public function create()
    {
        return view('posts.create');
    }

      // 作成機能
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();

        // ★画像がアップロードされていれば保存する
    if ($request->hasFile('image') && $request->file('image')->isValid()) {  // hasFile() で画像があるかチェック,isValid() でアップロードの失敗を防止
        $path = $request->file('image')->store('images', 'public'); // store('images', 'public') で storage/app/public/images/ に保存
        $post->image_path = $path; // Postモデルにimage_pathカラムがあることが前提
    }



        $post->save();

        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    // 編集ページ
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        return view('posts.edit', compact('post'));
    }

    // 更新機能
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        // ✅ 画像を削除するチェックがされていたら、画像削除
        if ($request->has('remove_image') && $post->image_path) {
            Storage::disk('public')->delete($post->image_path); // ストレージから削除
            $post->image_path = null; // データベースからも削除
        }

        // ✅ 新しい画像がアップロードされていたら、画像保存＆パスを更新

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image_path = $imagePath;
        }
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

 // 削除機能
    public function destroy(Post $post) {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }

}