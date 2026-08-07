@extends('layouts.home')

@section('content')


  <!-- Left Sidebar -->


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
            <h3 class="post-title"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
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


@endsection