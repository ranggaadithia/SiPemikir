<!DOCTYPE html>
<html lang="id" data-bs-color-scheme>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Expletus+Sans:ital,wght@0,400;0,600;0,700;1,400;1,700&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;0,700;1,200;1,300;1,400;1,600&display=swap" rel="stylesheet" />

    {{-- icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- ads  -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1464239538221765"
     crossorigin="anonymous"></script>
     
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/content-styles.css') }}">

    @yield('style')

    {!! SEO::generate() !!}

    <title>{{ $title }} | {{ env('APP_NAME') }}</title>    
  </head>
  <body class="theme-dark">
    
    @include('components.navbar')

    @yield('content')
  
    <div class="container">
      @yield('container')
    </div>

    @include('components.back-to-top')
    @include('components.footer')
    

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('show')

  </body>
</html>
