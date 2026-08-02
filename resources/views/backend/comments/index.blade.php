@extends('layouts.app')
@section('content')
  <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

      <h2 class="text-success">All Comments</h2>

      <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    @if(session('seccuss'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($comments->count())

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Comment</th>
              <th>Author</th>
              <th>Post</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comments as $comment)
              <tr>
                <td>
                  {{ $comments->firstItem() + $loop->index }}
                </td>
                <td>
                  {{ Str::limit($comment->comment, 80) }}
                </td>
                <td>
                  {{ $comment->user->name }}
                </td>
                <td>
                  {{ $comment->post->title }}
                </td>
                <td>
                  {{ $comment->created_at->diffforHumans() }}
                </td>
                <td>
                  <a href="{{ route('post.show', $comment->post) }}" class="btn btn-sm btn-primary">
                    View Post
                  </a>
                  <form action="{{ route('admin.comments.destroy', $comment) }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                      onclick="return confirm('Are you sure you want to delete this comment?')">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-3">
        {{ $comments->links() }}
      </div>
    @else
      <div class="alert alert-info">
        No comments found.
      </div>
    @endif
  </div>
@endsection