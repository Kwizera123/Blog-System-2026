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
  {{--
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"> --}}
  {{-- --}}
  <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />


  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  <!-- Responsive Navigation Bar -->
  @include('layouts.home-nav')

  <!-- Main Layout Container -->
  <div class="container main-layout">


    @include('layouts.home_left_sidebar')

    @yield('content')
    <!-- End Main Layout Container -->
    @include('layouts.home_right_sidebar')

  </div>

  <!-- Footer -->
  @include('layouts.home-footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>






  <script>
    function copyCode(button) {

      const codeBlock = button
        .closest('.tutorial-code-block');

      const code = codeBlock
        .querySelector('code')
        .innerText;

      navigator.clipboard.writeText(code);

      button.innerText = 'Copied!';

      setTimeout(() => {
        button.innerText = 'Copy';
      }, 2000);
    }
  </script>
</body>

</html>