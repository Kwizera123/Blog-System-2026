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
          <li><a href="#">Articles</a></li>
          <li><a href="#">Tutorials</a></li>
          <li><a href="#">About</a></li>
        </ul>

        <!-- Integrated Search Field Input -->

        <form action="{{ route('home') }}" method="GET">
          <div class="search-box">
            <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}">
            <button type="submit" class="search-btn"> 🔍</button>
          </div>
        </form>




        @auth
          {{-- <a href="{{ url('/dashboard') }}" class="nav-btn">
            My Profile
          </a> --}}
          <a href="{{ url('/blogprofile') }}" class="nav-btn">My Profile</a>

          <div class="dropdown">
            <a class="btn btn-light nav-btn btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ url('/blogprofile') }}">Profile</a></li>
              <!--Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <li><a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                       this.closest('form').submit();">{{ __('Log Out') }}</a></li>
              </form>

              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>


        @else
          <a href="{{ route('login') }}" class="nav-btn">
            Log in
          </a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-btn">
              Register
            </a>
          @endif
        @endauth

      </div>
    </div>
  </nav>
@endif