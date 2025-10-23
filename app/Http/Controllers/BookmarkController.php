<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    // ブックマーク登録
    public function store(Post $post)
    {
        $user = auth()->user();

        // すでに登録済みかチェック
        if (!$user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->create(['post_id' => $post->id]);
        }

        return back()->with('flash_message', 'ブックマークに追加しました！');
    }

    // ブックマーク解除
    public function destroy(Post $post)
    {
        $user = auth()->user();

        $user->bookmarks()->where('post_id', $post->id)->delete();

        return back()->with('flash_message', 'ブックマークを解除しました。');
    }
}
