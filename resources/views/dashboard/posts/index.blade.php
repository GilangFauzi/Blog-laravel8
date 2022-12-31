@extends('dashboard/layouts/main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    {{-- memanggil siapa yang sedang login --}}
    <h1 class="h2">My Posts!</h1>
</div>
   <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>

   {{-- jadi has disini biar terhubung sama flash data yang di controller --}}
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  <strong>Congrats!</strong> {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <div class="table-responsive col-lg-8">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
          <tr>
            {{-- loop iteration berfungsi buat penomoran mulai dari 1 --}}
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
                {{-- intinya kalau buat controller pake --resource itu cuma kek gini link nya --}}
                {{-- udah di setting di MODEL POST, jadi harusnya ID diganti slug, biar sama ama model yang dibuat, kalau emang mau ID, slug di model apus --}}
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="trash-2"></span></button>
                </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection