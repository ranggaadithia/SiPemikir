@extends('layouts.main')

@section('container')

@if ($page <= 1)
<div class="row my-3">
  <div class="col-lg-12">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner rounded shadow position-relative">
        @foreach ($posts->take(3) as $post)
        <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-white">
          <div class="carousel-item {{ $post == $posts[0] ? 'active' : '' }} headline headline-aft">
            @if ($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy" class="d-block w-100 headline-img">
            @else  
              <img src="https://source.unsplash.com/1080x1080/?headphone" loading="lazy" class="d-block w-100 headline-img" alt="{{ $post->title }}">
            @endif
            <div class="carousel-caption headline-content">
              <h5>{{ $post->title }}</h5>
              <p class="post-excerpt">{{ $post->excerpt }}</p>
              <p>By. <a href="/profile/{{ $post->author->username }}" class="text-decoration-none text-white"><strong>{{ $posts[0]->author->name }}</strong></a> {{ $posts[0]->updated_at->diffForhumans() }}</p>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>
@endif


<div class="row">
  @foreach ($posts->skip($page <= 1 ? 3 : 0) as $post)      
    <div class="col-sm-10 mt-3">
      <div class="card mb-3 p-3 shadow">
        <div class="row g-0">
          <div class="col-md-3">
            @if ($post->image)
              <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}">
            @else
              <img src="https://source.unsplash.com/1080x1080/?headphone" class="img-fluid rounded" alt="{{ $post->title }}">
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