@extends('layouts.main')

@section('container')  
<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="img/{{ $img }}" alt="{{ $name }}" width="130px">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title">{{ $name }}</h3>
        <p class="card-title">{{ $email }}</p>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>
@endsection