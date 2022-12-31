<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view('posts', [
            "title" => 'All Posts' . $title,
            "active" => 'posts',
            //all buat nampilin semua
            // "posts" => Post::all()

            //buat nampilin yang upload terbaru
            // fungsi with, agar website saat reload lebih optimal
            // "posts" => Post::latest()->get()
            // kalau pake search pake yang ini, kalau ngga, pake yang atas
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }
    public function show(Post $post)
    {
        return view('post', [
            "title" => 'Single Post',
            "active" => 'posts',
            "post" => $post
        ]);
    }
    // public function show($id)
    // {
    //     return view('post', [
    //         "title" => 'Single Post',
    //         "post" => Post::find($id)
    //     ]);
    // }
}