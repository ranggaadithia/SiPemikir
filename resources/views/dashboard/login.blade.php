@extends('layouts.main')

@section('container')
<div class="row justify-content-center text-center my-5">
  <div class="col-lg-5">
    <main class="form-signin">
      <img class="mb-4 shadow" src="/img/Logo.png" alt="Logo {{ env('APP_NAME') }}" width="72">
      <h1 class="h3 mb-3 fw-normal">Login</h1>
      @if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <form action="/login" method="post">
        @csrf
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}" autofocus>
          <label for="floatingInput">Email</label>
          @error('email')
            <div class="invalid-feedback text-start">
              {{ $message }}
            </div>
          @enderror
        </div>
        
        <div class="form-floating">
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
          @error('password')
            <div class="invalid-feedback text-start">
              {{ $message }}
            </div>
          @enderror
        </div>
    
        <div class="checkbox my-3 text-start">
          <label>
            <input type="checkbox" value="true" name="remember"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      </form>
      <p class="mt-3">Ingin menjadi penulis di <span class="title"><span>Si</span>Pemikir?</span> <br> <a href="https://wa.me/6285157740813" class="link-success">Hubungi Developer</a></p>
    </main>
  </div>
</div>
@endsection