<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    Comment::create([
        'content' => $request->content,
        'post_id' => $request->post_id,
        'user_id' => auth()->id(),
    ]);

    return back();
}

}
