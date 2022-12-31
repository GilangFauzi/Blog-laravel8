@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Posts</h1>
</div>
<div class="col-lg-8">
    {{-- yang action itu bakal otomatis bakal terhubung ke controller "dashboardPostController method store", jadi kalau pake resource cuma kaya gini --}}
    <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" disable readonly>
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" name="category_id">
            @foreach($categories as $category)
            {{-- jika category_id sama dengan category-> maka pilih --}}
            @if(old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            {{-- jika tidak, jalankan ini --}}
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
          </select>
        </div>
    
        <div class="mb-3">
          <label for="image" class="form-label">Post Image</label>
          <img class="img-preview img-fluid mb-3 col-sm-4">
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          @error('body')
          <p class="text-danger">{{ $message }}</p>
          @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
          <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
    </div>


<script>
  // buat slug otomatis ke isi
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

title.addEventListener('change', function(){
  // nanti diarahin ke route, dari route diarahin ke dashboard controller
  fetch('/dashboard/posts/checkSlug?title=' + title.value)
  .then(response => response.json())
  .then(data => slug.value = data.slug)
});

// buat non aktifkan fitur text editor trix
document.addEventListener('trix-file-accept',function (e){
  e.preventDefault();
});

// buat preview gambar cara 1
// function previewImage(){
//   const image = document.querySelector('#image');
//   const imgPreview = document.querySelector('.img-preview') 

//   imgPreview.style.display = 'block';

//   const oFReader = new FileReader();
//   oFReader.readAsDataURL(image.files[0]);

//   oFReader.onload = function(oFREvent){
//   imgPreview.src = oFREvent.target.result;

//   }
// }

// cara 2
function previewImage(){
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview') 

  imgPreview.style.display = 'block';

  const blob = URL.createObjectURL(image.files[0]);
  imgPreview.src = blob;
}


</script>
@endsection