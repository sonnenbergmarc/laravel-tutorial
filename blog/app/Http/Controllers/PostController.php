<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

}
