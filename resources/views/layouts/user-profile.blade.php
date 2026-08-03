<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Learn To Code</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  <!-- Responsive Navigation Bar -->
  @include('layouts.home-nav')





  {{-- --}}
  <!-- Error -->
  {{-- @if(session('error'))
  <div class="alert alert-danger mt-3">
    {{ session('error') }}
  </div>
  @endif --}}
  <!-- Uodate -->
  {{-- @if(session('info'))
  <div class="alert alert-info mt-3">
    {{ session('info') }}
  </div>
  @endif --}}
  {{-- @include('layouts.home_left_sidebar') --}}
  @yield('content')
  {{-- @include('layouts.home_right_sidebar') --}}
  <!-- Main Layout Container -->


  <!-- Footer -->
  @include('layouts.home-footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>