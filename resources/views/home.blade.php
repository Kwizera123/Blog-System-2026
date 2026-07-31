@extends('layouts.home')

@section('content')


  <!-- Left Sidebar -->
  <aside class="sidebar sidebar-left">
    <div class="widget">
      <h3>Categories</h3>
      <ul class="category-list">

        @foreach ($posts as $item)
          <li><a href="#">{{ $item->category->name }} <span>(12)</span></a></li>
        @endforeach

        {{-- <li><a href="#">Web Development <span>(12)</span></a></li>
        <li><a href="#">PHP & Laravel <span>(8)</span></a></li>
        <li><a href="#">CSS & Tailwind <span>(5)</span></a></li>
        <li><a href="#">JavaScript <span>(9)</span></a></li> --}}
      </ul>
    </div>
    <div class="widget">
      <h3>Popular Tags</h3>
      <div class="tag-cloud">
        <a href="#">Backend</a>
        <a href="#">Frontend</a>
        <a href="#">MVC</a>
      </div>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="content-area">
    <h2 class="section-title">Latest Articles</h2>

    <div class="posts-grid">

      @foreach ($posts as $post)
        <!-- Post 1 -->
        <article class="post-card">

          <div class="post-image">
            @if ($post->image)
              <img src="{{ asset('storage/' . $post->image) }}" alt="Code on screen">
              <span class="post-category">{{ $post->category->name }}</span>
            @else
              <img src="{{ asset('storage/no_image.png') }}" class="img-thumbnail" width="20" height="20"
                style="object-fit: cover;" alt="{{ $post->title }}">
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

      @endforeach

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