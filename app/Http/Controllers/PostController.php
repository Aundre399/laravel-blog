<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

         return view('posts', [
            //search filter scope created in post.php for Post::latest()->filter()->get(),
          'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
          'categories' => Category::all(),
          'currentcategory'=> Category::firstwhere ('slug', request('category'))
        ]);

    }

    public function show(Post $post){
        return view('post',[
            'post' => $post

          ]);
    }

}
