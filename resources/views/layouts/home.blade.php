<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learn To Code</title>
  <link rel="stylesheet" href="style.css">

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

  <div class="container main-layout">
    @if(session('success'))
      <div class="alert alert-success mt-3">
        {{ session('success') }}
      </div>
    @endif
    <!-- Error -->
    @if(session('error'))
      <div class="alert alert-danger mt-3">
        {{ session('error') }}
      </div>
    @endif
    <!-- Uodate -->
    @if(session('info'))
      <div class="alert alert-info mt-3">
        {{ session('info') }}
      </div>
    @endif

    @yield('content')
    <!-- Main Layout Container -->
  </div>

  <!-- Footer -->
  @include('layouts.home-footer')

</body>

</html>