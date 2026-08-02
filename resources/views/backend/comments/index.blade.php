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

    <div class="row mb-4">

      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="text-muted">
              Total Comments
            </h6>
            <h3>{{ $totalComments }}</h3>
          </div>
        </div>
      </div>


      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="text-warning">
              Pending Comments
            </h6>
            <h3>{{ $pendingComments }}</h3>
          </div>
        </div>
      </div>


      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="text-success">
              Approved Comments
            </h6>
            <h3>{{ $approvedComments }}</h3>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="text-danger">
              Hidden Comments
            </h6>
            <h3>{{ $hiddenComments }}</h3>
          </div>
        </div>
      </div>
    </div>

    <form action="{{ route('admin.comments.index') }}" method="GET" class="mb-4">

      <div class="row g-2">

        <div class="col-md-5">

          <input type="text" name="search" class="form-control" placeholder="Search, Authors or posts..."
            value="{{ request('search') }}">

        </div>

        <div class="col-md-3">

          <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="hidden" {{ request('status') === 'hidden' ? 'selected' : '' }}>Hidden</option>
          </select>

        </div>

        <div class="col-md-2">
          <button class="btn btn-sm btn-success w-100">Search</button>
        </div>
        @if (request('search'))
          <div class="col-md-2">
            <a href="{{ route('admin.comments.index') }}" class="btn btn-sm btn-secondary w-100">Clear</a>
          </div>
        @endif
      </div>
  </div>
  </form>

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
            <th>Status</th>
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
                @if($comment->status === 'approved')
                  <span class="badge bg-success">Approved</span>
                @elseif ($comment->status === 'hidden')
                  <span class="badge bg-danger">Hidden</span>
                @else
                  <span class="badge bg-warning text-dark">Pending</span>
                @endif
              </td>
              <td>
                <a href="{{ route('post.show', $comment->post) }}" class="btn btn-sm btn-primary">
                  View Post
                </a>
                {{-- Approve button--}}
                @if ($comment->status !== 'approved')

                  <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Approved</button>
                  </form>
                @endif
                {{-- Hide button --}}
                @if ($comment->status === 'approved')

                  <form action="{{ route('admin.comments.hide', $comment) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-warning">Hide</button>
                  </form>
                @endif

                {{-- Delete button --}}
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