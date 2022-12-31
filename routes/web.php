<?php

// use App\Models\Post;
// use App\Models\User;

use App\Http\Controllers\AdminCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('home', [
        "title" => 'HOME',
        "active" => 'home'
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => 'ABOUT',
        "active" => 'about',
        "name" => "Gilang Ganteng",
        "email" => "gilang@gmail.com",
        "img" => "gilang.jpg"
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});
// form ini hanya dapat di akses ketika user belum terotentikasi, jadi di pakein middleware 'guest'
// name('login') gunanya kalau user belum login dan mau ke dashboard via URL, maka di mentalin ke form login yang di ambil dari get login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
// kalau method nya post mengarah ke logout buka login controller, lalu arahkan ke method logout
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard hanya dapat di akses untuk user yang sudah login
// ini diganti pake clousure aja, jadi nya pake function
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('/dashboard.index');
})->middleware('auth');

// buat js slug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// MIDDLEWWARE digunakan biar bisa di akses kalau udah login aja, jadi buat membatasi
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// buat authorization yang terhubung sama AdminCategoryController, kalau gamau pake ini, apus aja route sama controllernya
// perintah except buat pengecualian di dalam AdminCategoryController, jadi method show ga dipake
// middleware('admin') itu dibuat manual, yang ada di dalam middleware, bisa aja script di dalam middleware di taro di controller, cuma malah jadi kurang efisies, karena nanti di setiap method harus di tambahin terus, solusinya buat middleware khusus.
// route ini sebelum ditambahkan gates
// Route::resource('dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

// reoute ini setelah udah di tambahin gates
Route::resource('dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

// fungsi load, agar website saat reload lebih optimal
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => 'Post By Category : ' . $category->name,
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author')
//     ]);
// });

// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => 'Post By Author : ' . $author->name,
//         'active' => 'posts',
//         'posts' => $author->posts->load('category', 'author')
//     ]);
// });