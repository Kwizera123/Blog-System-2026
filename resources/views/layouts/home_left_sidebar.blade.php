<aside class="sidebar sidebar-left">
  <div class="widget">
    <h3>Categories</h3>
    <form action="{{ request()->routeIs('blog.index') ? route('blog.index') : route('home') }}" method="GET">

      <select name="category" id="category" class="search-box text-white mt-2" style="width: 100%">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
          <option value=" {{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>

      <button type="submit" class="btn btn-sm bg-slate-400 mt-2 hover:bg-blue-400">Search</button>
    </form>

    <br>
    <ul class="category-list">

      @foreach ($categories as $category)
        <li>
          <a href="
                                                                              @if (request()->routeIs('blog.*'))
                                                                                {{ route('blog.index', ['category' => $category->id]) }}

                                                                              @elseif (request()->routeIs('tutorials.*'))
                                                                                {{ route('tutorials.index', ['category' => $category->id]) }}

                                                                              @else
                                                                                {{ route('home', ['category' => $category->id]) }}
                                                                              @endif
                                                                                          ">
            {{ $category->name }}
          </a>
        </li>
      @endforeach

    </ul>

  </div>

  <div class=" widget">
    <h3>Popular Tags</h3>
    <form action="{{ request()->routeIs('blog.index') ? route('blog.index') : route('home') }}" method="GET">
      <select name="tag" id="tag" class="search-box text-white mt-2" style="width: 100%">

        <option value="">All Tags</option>
        @foreach ($tags as $tag)
          <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
            {{ $tag->name }}
          </option>
        @endforeach

      </select>

      <button type="submit" class="btn btn-sm bg-slate-400 mt-2 hover:bg-blue-400">Search</button>

    </form>

    <div class="tag-cloud mt-3">

      @foreach ($tags as $tag)


        @php

          if (request()->routeIs('blog.*')) {

            $tagUrl = route('blog.index', [
              'tag' => $tag->id
            ]);

          } elseif (request()->routeIs('tutorials.*')) {

            $tagUrl = route('tutorials.index', [
              'tag' => $tag->id
            ]);

          } else {

            $tagUrl = route('home', [
              'tag' => $tag->id
            ]);

          }

        @endphp

        <a href="{{ $tagUrl }}" class="tag">
          {{ $tag->name }}
        </a>


      @endforeach

    </div>

  </div>


</aside>