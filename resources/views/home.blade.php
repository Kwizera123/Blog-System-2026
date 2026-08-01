@extends('layouts.home')

@section('content')


  <!-- Left Sidebar -->
  <aside class="sidebar sidebar-left">
    <div class="widget">
      <h3>Categories</h3>
      <form action="{{ route('home') }}" method="GET">

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
            <a href="{{ route('home', ['category' => $category->id]) }}">
              {{ $category->name }}
            </a>
          </li>
        @endforeach



      </ul>

    </div>

    <div class="widget">
      <h3>Popular Tags</h3>
      <form action="{{ route('home') }}" method="GET">
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
          <a href="{{ route('home', ['tag' => $tag->id]) }}" class="tag">{{ $tag->name }}</a>
        @endforeach
      </div>
    </div>


  </aside>

  <!-- Main Content Area -->
  <main class="content-area">
    <h2 class="section-title">Latest Articles</h2>
    {{-- Start Active filter summary--}}
    @if(
        request()->filled('search') ||
        request()->filled('category') ||
        request()->filled('tag')
      )
      <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>
          <strong>
            Showing {{ $posts->total() }}
            {{ Str::plural('post', $posts->total()) }}
          </strong>

          @if (request()->filled('search'))
            <span class="ms-2">
              Search: <strong>{{ request('search') }}</strong>
            </span>
          @endif

          @if (request()->filled('category'))
            <span class="ms-2">
              Category: <strong>
                {{ $categories->find(request('category'))?->name }}
              </strong>
            </span>
          @endif

          @if (request()->filled('tag'))
            <span class="ms-2">
              Tag: <strong>
                {{ $tags->find(request('tag'))?->name }}
              </strong>
            </span>
          @endif

        </div>
        <div>
          <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary hover:bg-blue-400">Clear Filters</a>
        </div>
      </div>
    @endif

    {{-- End of filter summary--}}
    @if(request('search'))

      <article class="post-card post-content">
        Search results for:
        <strong>{{ request('search') }}</strong>
        - {{ $posts->total() }}
        {{ Str::plural('post', $posts->total()) }}
      </article>

    @endif

    <br>
    <div class="posts-grid">

      @forelse ($posts as $post)
        <!-- Post 1 -->
        <article class="post-card">

          <div class="post-image">
            @if ($post->image)
              <img src="{{ asset('storage/' . $post->image) }}" alt="Code on screen">
              <span class="post-category">{{ $post->category->name }}</span>

            @endif
          </div>

          <div class="post-content">
            <div class="post-meta">{{ $post->created_at->diffForHumans() }}</div>
            <h3 class="post-title"><a href="#">{{ $post->title }}</a></h3>
            <p class="post-excerpt">{{ Str::limit($post->content, 120) }}</p>
            <div class="post-meta">By: <strong>{{ $post->user->name }}</strong></div>
            <a href="{{ route('post.show', $post->slug) }}" class="read-more">Read Article &rarr;</a>
          </div>
        </article>
      @empty

        @if(request('search'))

          <article class="post-card post-content">
            Search results for:
            <strong>{{ request('search') }}</strong>
            - {{ $posts->total() }}
            {{ Str::plural('post', $posts->total()) }}
          </article>

        @else
          No published posts are available yet.

        @endif

      @endforelse

    </div>
    <div class="mt-4">
      {{ $posts->links() }}
    </div>
  </main>

  <!-- Right Sidebar -->
  <aside class="sidebar sidebar-right">
    <div class="widget author-widget">
      <h3>About The Blog</h3>
      <p>Welcome to DevInsights, a curated platform focused on bringing you crisp web development guides and backend
        architectural breakdowns.</p>
    </div>

    <div class="widget">
      <h3>Trending Content</h3>
      <ul class="trending-list">
        <li>
          <a href="#">Optimizing Eloquent Queries for Heavy Traffic</a>
          <span class="date">5 days ago</span>
        </li>
        <li>
          <a href="#">Why Core PHP Knowledge Changes Everything</a>
          <span class="date">1 week ago</span>
        </li>
      </ul>
    </div>
  </aside>

@endsection