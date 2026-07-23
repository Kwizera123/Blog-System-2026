@extends('layouts.app')
@section('content')
  <div class="container mt-4">



    <h2 class="h2 text-success">All Posts</h2><br>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+Create post</a>
    <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
      <div class="row">
        <div class="col-md-6">
          <input type="text" name="search" class="form-control" placeholder="Search posts... "
            value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
          <button class="btn btn-success">Search</button>
        </div>
      </div><br>

      <div class="col-md-3">
        <select name="sort" class="form-select form-control" onchange="this.form.submit()">
          <option value="">Newest First</option>

          <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>

          <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>

          <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
        </select>

      </div>

    </form>
    @if($posts->count() > 0)
      <table class="table table-striped bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Content</th>
            <th>Image</th>
            <th>Video</th>
            <th>Status</th>
            <th>Author</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>{{ $post->category->name }}</td>
              <td>{{ Str::limit($post->content, 25) }}</td>
              <td>
                @if($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail" width="50" height="50"
                    style="object-fit: cover;" alt="{{ $post->title }}">
                @else <span class="text-muted">No Image</span> @endif
              </td>
              <td>
                @if($post->video_url)
                  @php
                    $embedUrl = $post->video_url;

                    if (str_contains($embedUrl, 'watch?v=')) {
                      $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                    }

                    if (str_contains($embedUrl, 'youtu.be/')) {
                      $embedUrl = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $embedUrl);
                    }
                  @endphp

                  <div class="ratio ratio-21x9">

                    <iframe class="img-thumbnail" src="{{ $embedUrl }}" title="{{ $post->title }}"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>

                @else
                    <div class="text-mutes">
                      No Video
                    </div>
                  @endif
                  {{-- @if($post->embed_video_url)

                  <iframe src="{{ $post->embed_video_url }}"></iframe>

                  @endif --}}
              </td>
              <td>{{ $post->status }}</td>
              <td>{{ $post->user->name }}</td>
              <td>
                <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="Post" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger"
                    onclick="return confirm('Are You Sure you want to delete this post? ')">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    @else
      <p>No Post found.</p>
    @endif
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">Back</a>
    <div class="mt-3">
      {{ $posts->links() }}
    </div>
  </div>
<br>@endsection