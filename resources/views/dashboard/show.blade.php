@extends('layouts.dashboard')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $post->title }}</h1>
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
      <a href="/dashboard/posts" class="btn btn-success"><i class="bi bi-arrow-left"></i></a>
      <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
      <form action="/dashboard/posts/{{ $post->slug }}" method="post">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
      </form>
    </div>
  </div>

  
  <div class="card my-3 headline bg-dark text-white border-0 rounded-3 overflow-hidden shadow">
    @if ($post->image)
      <img src="{{ asset('storage/'.$post->image) }}" alt="" class="card-img headline-img">
    @else
      <img src="https://source.unsplash.com/1080x1080/?headphone" class="card-img headline-img" alt="">
    @endif
  </div>
  <article class="fs-5 mb-4 ck-content">
    {!! $post->body !!}
  </article>
  <ul>
    @foreach ($post->tags as $tag)
        <li>{{ $tag->name }}</li>
    @endforeach
  </ul>
  <p class="border-bottom">Detail Post</p>
  <ul class="list-unstyled mb-5">
    <li>
      <p class="text-muted">Relase Date : {{ $post->updated_at }}</p>
    </li>
    <li>
      <p class="text-muted">Slug : {{ $post->slug }}</p>
    </li>
    <li>
      <p class="text-muted">ID Post : {{ $post->id }}</p>
    </li>
    <li>
      <p class="text-muted">Author : {{ $post->author->name }}</p>
    </li>
  </ul>
</main>

@endsection