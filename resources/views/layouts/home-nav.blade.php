@if (Route::has('login'))
  <nav class="navbar">
    <div class="nav-container">
      <a href="{{ route('home') }}" class="nav-logo">Learn<span>ToCode</span></a>

      <!-- Hidden checkbox trick to handle mobile menu without forcing JavaScript -->
      <input type="checkbox" id="menu-toggle" class="menu-toggle">
      <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </label>

      <div class="nav-menu">
        <ul class="nav-links">
          <li><a href="/" class="active">Home</a></li>
          <li><a href="#">Tutorials</a></li>
          <li><a href="#">About</a></li>
          <li><a href="blog">Blog</a></li>
        </ul>

        <!-- Integrated Search Field Input -->

        <form action="{{ route('home') }}" method="GET">
          <div class="search-box">
            <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}">
            <button type="submit" class="search-btn"> 🔍</button>
          </div>
        </form>


        <!--temporarily Closed-->
        {{-- @guest
        <a href="{{ route('login') }}" class="nav-btn">Login</a>
        <a href="{{ route('register') }}" class="nav-btn">Register</a>
        @endguest --}}

        {{-- Authenticated --}}
        {{-- @auth

        @can('create', App\Models\Post::class)
        <li>
          <a href="{{ route('posts.index') }}" class="dropdown-item">Post</a>
        </li>
        <li>
          <a href="{{ route('posts.my') }}" class="dropdown-item">My Posts</a>
        </li>
        @endcan

        @if(auth()->user()->isAdmin())
        <li>
          <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
            Admin Dashboard
          </a>
        </li>
        @endif
        <li><a class="dropdown-item" href="{{ url('/blogprofile') }}">Profile</a></li>

        <li>
          <hr class="dropdown-divider">
        </li>
        <!--Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <li><a class="dropdown-item" href="route('logout')"
              onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   this.closest('form').submit();">{{
              __('Log Out') }}</a>
          </li>
        </form>

        @endauth --}}
        <!--End temporarily Closed Authantication-->

        <!--Authantication under use  -->

        @auth

          <div class="dropdown">

            <a class="btn btn-light nav-btn btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu">

              {{-- Profile --}}
              <li><a class="dropdown-item" href="{{ url('/blogprofile') }}">Profile</a></li>

              {{-- User Dashboard --}}
              <li><a href="{{ url('dashboard') }}" class="dropdown-item">
                  Dashboard
                </a></li>

              {{-- Post Management --}}
              @can('create', App\Models\Post::class)
                <li>
                  <a href="{{ route('posts.index') }}" class="dropdown-item">Posts</a>
                </li>
                <li>
                  <a href="{{ route('posts.my') }}" class="dropdown-item">My Posts</a>
                </li>
              @endcan

              {{-- Admin Area--}}
              @if(auth()->user()->isAdmin())
                <li>
                  <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                    Admin Dashboard
                  </a>
                </li>
              @endif

              <li>
                <hr class="dropdown-divider">
              </li>
              <!--Logout -->
              <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
              </div>
            </ul>
          </div>
        @else
          {{-- Guest / Visitor Navigation --}}
          <a href="{{ route('login') }}" class="nav-btn">
            Log in
          </a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-btn">
              Register
            </a>
          @endif

        @endauth
        <!--End Authantication under use  -->

      </div>
    </div>
  </nav>
@endif