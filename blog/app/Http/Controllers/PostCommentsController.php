<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        // add a comment to the given post.

        // validation
        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            // different ways of writing the user_id
            // 'user_id' => auth()->id(),
            // 'user_id' => auth()->user()->id,
            'user_id' => request()->user()->id,
            'body' => request('body')
            // If using the Request $request method in the store function
            // 'user_id' => $request->user()-id,
            // 'body' => $request->input('body')
        ]);

        return back();
    }
}
