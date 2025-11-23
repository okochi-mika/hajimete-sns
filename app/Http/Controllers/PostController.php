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
        $posts = Post::orderBy('created_at', 'desc')->get();


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

    // ★動画がアップロードされていれば保存する
    if ($request->hasFile('videos') && $request->file('videos')->isValid()) { // hasFile() で動画があるかチェック,isValid() でアップロードの失敗を防止
        $path = $request->file('videos')->store('videos', 'public'); // store('videos', 'public') で storage/app/public/videos/ に保存
        $post->videos_path = $path;  // Postモデルにvideos_pathカラムがあることが前提、カラム名はvideos_pathで統一
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
    // 不正アクセス防止
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')
            ->with('error_message', '不正なアクセスです。');
    }

    // タイトル・本文を更新
    $post->title = $request->input('title');
    $post->content = $request->input('content');

    // ✅ 画像削除処理
    if ($request->has('remove_image') && $request->input('remove_image') == 1) {
        if ($post->image_path) {
            // 古い画像があれば削除
            Storage::disk('public')->delete($post->image_path);
            $post->image_path = null;
        }
    }

    // ✅ 動画削除処理
    if ($request->has('remove_video') && $request->input('remove_video') == 1) {
        if ($post->videos_path) {
            //  古い動画があれば削除
            Storage::disk('public')->delete($post->video_path);
            $post->video_path = null;
        }
    }
    
    // ✅ 新しい画像がアップロードされた場合
    if ($request->hasFile('image')) {
        // 古い画像が残っていれば削除
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        // 新しい画像を保存
        $path = $request->file('image')->store('images', 'public');
        $post->image_path = $path;
    }

    // ✅ 新しい動画がアップロードされた場合

    if ($request->hasFile('video')) {
        // 古い動画が残っていれば削除
        if ($post->videos_path) {
            Storage::disk('public')->delete($post->video_path);
        }
        // 新しい動画を保存
        $path = $request->file('videos')->store('video', 'public');
        $post->video_path =$path;
    }
    
    // 保存
    $post->save();

    return redirect()->route('posts.show', $post)
        ->with('flash_message', '投稿を編集しました。');
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