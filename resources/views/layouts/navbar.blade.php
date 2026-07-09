<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <div class="container">

    <a class="navbar-brand" href="/">My Blog</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

        @auth
          Welcome, {{ auth()->user()->name }}!
        @else
          <a href="/login" class="text-white">Login</a>
          <a href="/register" class="text-white ms-2">Register</a>
        @endauth

        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/Services">Services</a>
        </li>

        <li class="nav-item">
          @auth
            <a class="nav-link" href="{{ route('posts.my') }}">My Posts</a>
          @endauth
        </li>

      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <form class="d-flex" style="margin-left: 50px;" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">
          Logout
        </button>
      </form>


    </div>
</nav>