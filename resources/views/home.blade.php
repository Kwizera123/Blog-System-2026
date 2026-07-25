@extends('layouts.home')

@section('content')


  <!-- Left Sidebar -->
  <aside class="sidebar sidebar-left">
    <div class="widget">
      <h3>Categories</h3>
      <ul class="category-list">
        <li><a href="#">Web Development <span>(12)</span></a></li>
        <li><a href="#">PHP & Laravel <span>(8)</span></a></li>
        <li><a href="#">CSS & Tailwind <span>(5)</span></a></li>
        <li><a href="#">JavaScript <span>(9)</span></a></li>
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
      <!-- Post 1 -->
      <article class="post-card">
        <div class="post-image">
          <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80"
            alt="Code on screen">
          <span class="post-category">Web Development</span>
        </div>
        <div class="post-content">
          <div class="post-meta">July 9, 2026</div>
          <h3 class="post-title"><a href="#">Building Scalable Applications with Modern Architecture</a></h3>
          <p class="post-excerpt">Discover the essential patterns and practices required to design clean,
            maintainable
            codebases that handle growth seamlessly.</p>
          <a href="#" class="read-more">Read Article &rarr;</a>
        </div>
      </article>

      <!-- Post 2 -->
      <article class="post-card">
        <div class="post-image">
          <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80"
            alt="Laptop on desk">
          <span class="post-category">PHP & Laravel</span>
        </div>
        <div class="post-content">
          <div class="post-meta">July 6, 2026</div>
          <h3 class="post-title"><a href="#">Mastering Route Model Binding in Custom Dashboards</a></h3>
          <p class="post-excerpt">Simplify your controller logic and optimize database queries using implicit and
            explicit binding methods effectively.</p>
          <a href="#" class="read-more">Read Article &rarr;</a>
        </div>
      </article>

      <!-- Post 3 -->
      <article class="post-card">
        <div class="post-image">
          <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80"
            alt="Design sketches">
          <span class="post-category">CSS & Tailwind</span>
        </div>
        <div class="post-content">
          <div class="post-meta">June 28, 2026</div>
          <h3 class="post-title"><a href="#">Crafting Eye-Strain Free Dynamic Layouts</a></h3>
          <p class="post-excerpt">A deep dive into styling interfaces with low blue light configurations and warm
            visual hierarchies for developer comfort.</p>
          <a href="#" class="read-more">Read Article &rarr;</a>
        </div>
      </article>
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