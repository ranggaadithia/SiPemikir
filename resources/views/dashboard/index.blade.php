@extends('layouts.dashboard')

@section('container')
  <main class="">
    @if (session()->has('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Your Posts</h1>
      <a href="/dashboard/posts/create" class="btn btn-primary">Create New Post</a>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Excerpt</th>
            <th scope="col">Realese Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)    
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->excerpt }}</td>
              <td>{{ $post->updated_at }}</td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                  <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                  <form action="/dashboard/posts/{{ $post->slug }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</main>
@endsection