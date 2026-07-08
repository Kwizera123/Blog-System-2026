<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand" href="/">My Blog</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <ul class="navbar-nav ms-auto ">

        @auth
          Welcome, {{ auth()->user()->name }}!
        @else
          <a href="/login" class="text-white">Login</a>
          <a href="/register" class="text-white ms-2">Register</a>
        @endauth

        <li class="nav-item">
          <a class="nav-link text-white" href="/">Home</a>
        </li>

        <li class="nav-item text-white">
          <a class="nav-link" href="/contact">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        @auth
          <a class="text-white" href="{{ route('posts.my') }}">My Posts</a>
        @endauth

      </ul>

    </div>

  </div>
</nav>