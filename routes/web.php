<?php

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
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
        "posts" => Post::all()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) { // laravel behind the scenes Post::find($post)->firstOrFail();
    return view("post", [
        "post" => $post
    ]);
});

Route::get("categories/{category:slug}", function (Category $category) {
   return view("posts", [
       "posts" => $category->posts
   ]);
});
