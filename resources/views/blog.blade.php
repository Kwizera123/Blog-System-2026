@extends('layouts.home')

@section('content')

  <div class="container py-4">


    <form action=" {{ route('blog.index') }}" method="GET">

      <div class="row">

        <div class="col-md-10">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control"
            placeholder="Search blog...">
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-sm btn-primary">
            Search
          </button>
        </div>
      </div>
    </form>


    <h1 class="mb-4 mt-4">📝 Blog</h1>

    <p class="text-muted">
      Latest published articles and posts.
    </p>

    @forelse ($posts as $post)

      <article class="card mb-4 shadow-sm">
        <div class="card-body">

          <h2 class="h4">
            {{ $post->title }}
          </h2>

          <p class="text-muted mb-2">
            By {{ $post->user->name }}
            · {{ $post->created_at->diffForHumans() }}
          </p>

          <p>
            {{ Str::limit(strip_tags($post->content), 180) }}
          </p>

          <a href="{{ route('post.show', $post) }}" class="btn btn-sm btn-primary mt-1">
            Read More
          </a>

        </div>
      </article>

    @empty

      <div class="alert alert-info">
        No published posts found.
      </div>

    @endforelse

    {{ $posts->links() }}


  </div>

@endsection