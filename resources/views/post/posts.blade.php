@extends('layouts.main')

@section('container')
<div class="row">
  <h3 class="fw-normal my-3">#{{ $tag }} <span class="badge bg-primary">{{ $posts->count() }}</span></h3>
  @foreach ($posts as $post)      
    <div class="col-sm-10 mt-3">
      <div class="card mb-3 p-3 shadow">
        <div class="row g-0">
          <div class="col-md-3">
            <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}" loading="lazy">
          </div>
          <div class="col-md-8">
            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-white-50">{{ $post->excerpt }}</p>
                <p class="card-text mt-2"><small class="text-muted">By. <a href="{{ route('profile', ['author' => $post->author->username]) }}" class="text-decoration-none text-muted"><strong>{{ $post->author->name }}</strong></a> {{ $post->updated_at->diffForhumans() }}</small></p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection