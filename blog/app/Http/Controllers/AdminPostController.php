<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        // $attributes = $this->validatePost(new Post());

        // $attributes['user_id'] = auth()->id();
        // $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        // The below code is the same as the above although a bit cleaner/

        // $attributes = array_merge($this->validatePost(), [
        //     'user_id' => request()->user()->id,
        //     'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        // ]);

        // Post::create($attributes);

        // The below code is the same as the above, again just slightly cleaner but not much.
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }


        $post->update($attributes);

        return back()->with('success', 'Post Updated Successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted Successfully!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] :['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
