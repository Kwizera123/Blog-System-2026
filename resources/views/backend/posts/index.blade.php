@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2 class="">All Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+Create post</a>
    @if($posts->count() > 0)
      <table class="table bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Content</th>
            <th>Image</th>
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
                  <img src="{{ asset('storage/' . $post->image) }}" width="50" height="50" style="object-fit: cover;">
                @else No Image @endif
              </td>
              <td>{{ $post->user->name }}</td>
              <td>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
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
  </div>
@endsection