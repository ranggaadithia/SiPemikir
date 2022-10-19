@extends('layouts.dashboard')

@section('container')
<main class="">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
  </div>

  <div class="row">
    <div class="col-lg-7">
      <form action="/dashboard/posts" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="name" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly required value="{{ old('slug') }}">
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="tags">Tags</label>
          <input class="form-control @error('tags') is-invalid @enderror" type="text" data-role="tagsinput" name="tags" id="tags" value="{{ old('tags') }}">
          @error('tags')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <img class="img-preview img-fluid mb-3 col-lg-8 d-block">
          <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="imagePreview();">
          @error('image')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          <textarea name="body" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
          @error('body')
          <div class="alert alert-danger" role="alert">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3 text-center">
          <button type="submit" class="btn btn-outline-primary">Create Post</button>
        </div>
      </form>
    </div>
  </div>
  
</main>

@endsection