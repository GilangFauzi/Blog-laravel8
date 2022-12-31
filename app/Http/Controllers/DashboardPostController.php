<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // jadi, ambilkan data POST yang user ID nya sama dengan yang sedang login 
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // singkatan dari die,dump, and debug
        // ddd($request);

        // upload file
        // jadi file apapun akan di simpan di post-images
        // return $request->file('image')->store('post-images');

        // perintah buat validasi data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // harus unik dari tabel posts
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            // jadi file harus image, terus harus pake bacaan file, biar bisa nentuin urusan maximal image yang di upload, kalau ngga, dia anggapnya itu max dari integer
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // jadi, kalau kosong, if ini tidak dijalakan, tapi jika lolos semua validasi, if ini dapat di run.
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // jadi, jika lolos validasi, maka akan create data
        // untuk nilai user_id, itu dia ambilnya dari user id, ga di isi, jadi otomatis ambil dari user_id di tabel user
        $validatedData['user_id'] = auth()->user()->id;
        // perintah dibawah, biar text ambil dari body sebanyak 200 kata. stip_tags biar semua tag html di dalam body hilang, tapi kalau strip tag di ilangin juga gapapa
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200));
        Post::create($validatedData);

        // kalau udah semua balikin ke form sebelum nya. with berguna biar ada info nya atau flash data
        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // perintah disini buat nampilin data di form edit
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // biar slug ga bentrok sama slug yang udah ada
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            // cek jika ada gambar lama, maka hapus
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        // perintah dibawah, biar text ambil dari body sebanyak 200 kata. stip_tags biar semua tag html di dalam body hilang, tapi kalau strip tag di ilangin juga gapapa
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200));

        // perintah buat update
        Post::where('id', $post->id)->update($validatedData);

        // kalau udah semua balikin ke form sebelum nya. with berguna biar ada info nya atau flash data
        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // hapus gambar
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    // biar js nya jalan pake ini
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}