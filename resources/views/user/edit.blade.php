@extends('layouts.dashboard')

@section('container')
<main class="">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Profile {{ $user->name }}</h1>
  </div>

  @if (session()->has('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

  <div class="row">
    <div class="col-lg-7 mb-5">
      <form action="/dashboard/users/{{ $user->username }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="mb-3">
        <label for="banner" class="form-label">Banner</label>
        @if ($user->banner)
            <img src="{{ asset('storage/'.$user->banner) }}" alt="" class="img-preview overflow-hidden img-fluid">
        @else
          <img class="img-preview overflow-hidden img-fluid">
        @endif
        <input class="form-control image" type="file" id="image" name="banner" onchange="imagePreview();">
      </div>

      
        <label for="image" class="form-label">Profile Picture</label>
        <div class="d-flex align-items-center mb-3">
          @if ($user->profile_picture)
              <img src="{{ asset('storage/'.$user->profile_picture) }}" width="80" alt="" class="img-preview rounded-circle overflow-hidden">
          @else
            <img class="img-preview rounded-circle overflow-hidden" width="80">
          @endif
          <div class="mb-3 align-items-center">
            <input class="form-control form-control-sm" id="image" name="profile_picture" class="image" type="file" onchange="imagePreview();">
          </div>
        </div>

        <div class="mb-3">
          <label for="id" class="form-label">ID User</label>
          <input type="text" class="form-control" id="id" name="id" readonly value="{{ $user->id }}">
        </div>
        <div class="mb-3">
          <label for="id" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email" readonly value="{{ $user->email }}">
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">BIO</label>
          <textarea class="form-control" id="bio" name="bio" rows="5">{{ $user->bio }}</textarea>
        </div>

        <label for="sosmed">Social Media Links</label>
        <div class="row mb-3">
          @foreach ($user->sosmed as $sosmed) 
          <input type="hidden" name="id_sosmed {{ $sosmed->id }}" value="{{ $sosmed->id }}" id="id_sosmed">
          <div class="col-6">
            <div class="form-floating mb-3">
              <input type="url" class="form-control" id="sosmed" name="sosmed_{{ $sosmed->id }}" value="{{ $sosmed->link }}">
              <label for="sosmed">{{ $sosmed->name }}</label>
            </div>
          </div>
          @endforeach
        </div>
        
        <div class="mb-3 text-center">
          <button type="submit" class="btn btn-outline-success">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
  
</main>
@endsection