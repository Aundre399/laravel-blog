<?php
use App\models\post;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('posts', [
      'posts' => post::all()
    ]);
});

Route::get('posts/{post:slug}', function(post $post) {
  return view('post',[
    'post' => $post
  ]);


    //$path = __DIR__ . "/../resources/posts/{$slug}.html";




});
