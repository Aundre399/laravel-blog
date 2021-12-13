<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index' , [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {

        return view('admin.posts.create');
    }

    public function store()
    {

       $Attributes = request()->validate([
           'title' => 'required',
           'thumbnail' => 'required|image',
           'slug' => ['required', Rule::unique('posts', 'slug')],
           'excerpt' => 'required',
           'body' => 'required',
           'category_id' => ['required', Rule::exists('categories', 'id')]
       ]);

       $Attributes['user_id'] = auth()->id();
       $Attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

       Post::create( $Attributes );

       return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit' , ['post' => $post]);
    }

    public function update(Post $post)
    {
        $Attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if (isset($Attributes['thumbnail'])){
            $Attributes['thumbnail']= request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($Attributes);

        return back()-> with('success', 'Post Updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()-> with('success', 'Post Deleted');
    }
}
