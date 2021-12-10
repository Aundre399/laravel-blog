<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

        return view('posts.index', [
            //search filter scope created in post.php for Post::latest()->filter()->get(),
            //   'posts' => Post::latest()->filter(request(['search','category', 'author.]))->get(),
            //'categories' => Category::all(),

            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))
            ->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post

        ]);
    }
}
