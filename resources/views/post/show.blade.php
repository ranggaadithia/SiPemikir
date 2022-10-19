@extends('layouts.main')

@section('container')

  <div class="row justify-content-center">
    <div class="col-md-10 my-3">
      <h1 class="my-3">{{ $post->title }}</h1>
        @auth
          <div class="d-flex my-3">
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mx-1"><i class="bi bi-pencil"></i></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        @endauth
      <div class="card bg-dark text-white border-0 rounded-3 overflow-hidden shadow">
        @if ($post->image)
          <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="{{ $post->title }}" loading="lazy">
        @else
          <img src="https://source.unsplash.com/1080x1080/?headphone" class="card-img headline-img" alt="" loading="lazy">
        @endif
      </div>

      <article class="mt-3 fs-5 text-justify ck-content">
        {!! $post->body !!}
      </article>

      <h5>Tags :</h5>
      <div class="card mb-3">
        <div class="card-body">
          <div class="d-flex flex-wrap">
            @foreach ($post->tags as $tag)
              <a href="{{ route('tag', ['tag' => $tag]) }}" class="badge bg-primary m-1">{{ $tag->name }}</a>
            @endforeach
          </div>
        </div>
      </div>
      
      <a href="/profile/{{ $post->author->username }}" class="text-decoration-none text-black">
        <div class="py-2 border-bottom border-top my-4 d-flex align-items-center">
          <div class="flex-shrink-0">
            <img src="{{ asset('storage/'.$post->author->profile_picture) }}" alt="Profile User" class="rounded-circle img-fluid" width="70" loading="lazy">
          </div>
          <div class="ms-3 flex-grow-1">
            <h5 class="mt-3 ">{{ $post->author->name }}</h5>
            <p class="text-white-50">{{ $post->updated_at->diffForhumans() }}</p>
          </div>
        </div>
      </a>

      @if (!empty($postSuggestions))
        <div class="row mt-3">
          <h2>Postingan Serupa</h2>
          @foreach ($postSuggestions as $post)
          <div class="col-sm-6 col-lg-4">
              <a href="{{ $post->slug }}" class="text-decoration-none text-dark">
              <div class="card mb-3">
                <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" alt="{{ $post->title }}" loading="lazy">
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text text-white-50">{{ $post->excerpt }}</p>
                </div>
              </div>
            </a>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>

  @include('components.social-media-share')

@endsection

@section('show')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/share.js') }}"></script>
  <script charset="utf-8" src="https://cdn.iframe.ly/embed.js?api_key=fba6303aa9693558dd4c91"></script>
  <script>
      document.querySelectorAll( 'oembed[url]' ).forEach( element => {
          iframely.load( element, element.attributes.url.value );
      } );
    </script>
@endsection