@extends('layouts.main')

@if ($author->banner)
  @section('style')
      <style>
        .profile-banner {
          background-image: url({{ asset('storage/'.$author->banner) }});
        }
      </style>
  @endsection
@endif

@section('content')
    
<div class="profile-banner">
  <div class="p-3 mx-auto">
    <p class="text-center text-white fs-5">Social Media :</p>
    <ul class="list-unstyled d-flex justify-content-center gap-3">
      @foreach ($author->sosmed->whereNotNull('link') as $sosmed)
        <li><a href="{{ $sosmed->link }}" class="text-white fs-5" target="_blank" rel="noreferrer noopener"><i class="bi bi-{{ $sosmed->name }}"></i></a></li>
      @endforeach
    </ul>
  </div>
</div>

@endsection

@section('container')

<div class="d-flex justify-content-center">
  <div class="profile-pic">
    <img src="{{ asset('storage/'.$author->profile_picture) }}" alt="" class="rounded-circle img-thumbnail shadow" width="150" loading="lazy">
  </div>
</div>
<div class="row my-2 justify-content-center">
  <div class="col-lg-10">
    <h2 class="title text-center">{{ $author->name }}</h2>
    <p class="my-3 text-center">{{ $author->bio }}</p>
  </div>
</div>
<hr>
<div class="row">
  <h3>Postingan dari {{ $author->name }}</h3>
  @foreach ($posts as $post)
    <div class="col-sm-10 mt-3">
      <div class="card mb-3 p-3 shadow">
        <div class="row g-0">
          <div class="col-md-3">
            @if ($post->image)
              <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}" loading="lazy">
            @else
              <img src="https://source.unsplash.com/1080x1080/?headphone" class="img-fluid rounded" alt="..." loading="lazy">
            @endif
          </div>
          <div class="col-md-8">
            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-white-50">{{ $post->excerpt }}</p>
                <p class="card-text mt-2"><small class="text-muted">By. <a href="/profile/{{ $post->author->username }}" class="text-decoration-none text-muted"><strong>{{ $post->author->name }}</strong></a> {{ $post->updated_at->diffForhumans() }}</small></p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-flex justify-content-center my-3">
  {{ $posts->links() }}
</div>
@endsection