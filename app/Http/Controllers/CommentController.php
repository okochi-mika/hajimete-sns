<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
public function store(Request $request, \App\Models\Post $post)
{
    $request->validate([
        'content' => 'required',
    ]);

    Comment::create([
        'content' => $request->content,
        'post_id' => $post->id,
        'user_id' => auth()->id(),
    ]);

    return back();
}

public function destroy(Comment $comment)
{
    
    // 自分のコメントじゃなければ拒否
    if ($comment->user_id !== auth()->id()) {
        return back()->with('error_message', '不正な操作です');
    }

    $comment->delete();

    return back()->with('flash_message', 'コメントを削除しました');
    
}

}

