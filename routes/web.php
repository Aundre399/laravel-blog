<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\models\post;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments',[PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [sessionsController::class, 'create'])->middleware('guest');
Route::post('login', [sessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [sessionsController::class, 'destroy'])->middleware('auth');


// Route::get('categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'posts' => $category->posts,
//         'currentcategory'=> $category,
//         'categories' => Category::all()
//       ]);

// })->name('category');

// Route::get('authors/{author:username}', function(User $author){
//     return view('posts.index', [
//         'posts' => $author->posts
//        // 'categories' => Category::all()
//       ]);

//});
