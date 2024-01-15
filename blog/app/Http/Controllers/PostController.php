<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;



class PostController extends Controller
{
    public function index()
    {

        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
            // 'currentCategory' => Category::where('slug', request('category'))->first()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    // protected function getPosts()
    // {

    //     return Post::latest()->filter()->get();
    // //     $posts = Post::latest();

    // //     if (request('search')) {
    // //         $posts
    // //             ->where('title', 'like', '%'. request('search') .'%')
    // //             ->orWhere('body', 'like', '%'. request('search') .'%');
    // //     }

    // //     return $posts->get();
    // }
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }
}
