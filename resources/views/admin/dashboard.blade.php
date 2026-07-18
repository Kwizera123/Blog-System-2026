@extends('layouts.app')
@section('content')
  <div class="container">

    <div class="mb-4">

      <h1>
        Welcome Back, {{ auth()->user()->name }}
      </h1>
      <p class="text-muted">Here is what is happening in youe application today.</p>
    </div>

    <div class="row mt-4">

      <div class="col-md-3">
        <div class="card text-center shadow-sm text-bg-success">
          <div class=" card-body">
            <h5>👥 Total User: </h5>
            <h2>{{ $totalUsers }}</h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn- text-white">View</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center shadow-sm text-bg-primary">
          <div class="card-body">
            <h5>📝 Total Posts: </h5>
            <h2>{{ $totalPosts }}</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn- text-white">View</a>

          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center text-bg-danger shadow-sm">
          <div class="card-body">
            <h5>💬 Total Comments: </h5>
            <h2>{{ $totalComments }}</h2>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center text-bg-warning shadow-sm">
          <div class="card-body">
            <h5>🗂️ Total Categorie: </h5>
            <h2>{{ $totalCategories }}</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn- text-white">View</a>
          </div>
        </div>
      </div>

    </div>
    <hr class="my-5">
    <h3>Recent Post</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Created</th>
          <th>More...</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($recentPosts as $post)
          <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>
              <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </td>
          </tr>
        @empty
          <tr colspan="3" class="text-center text-muted">
            <td>No Posts found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <hr class="my-5">
    <h3>Latest Users</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>Role</td>
          <td>Joined</td>
        </tr>
      </thead>
      <tbody>
        @forelse ($latestUsers as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if($user->role === 'admin')
                <span class="badge bg-success">Admin</span>
              @else
                <span class="badge bg-secondary">Author</span>
              @endif
            </td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted">No Users found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <hr class="my-5">
    <h3>Recent comments</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <td>User</td>
          <td>Post</td>
          <td>Comment</td>
          <td>created</td>
        </tr>
      </thead>
      <tbody>
        @forelse ($recentComments as $comment)
          <tr>
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->post->title }}</td>
            <td>{{ Str::limit($comment->comment, 50) }}</td>
            <td>{{ $comment->created_at->diffForHumans() }}</td>
          </tr>
        @empty
          <tr colspan="4" class="text-center text-muted">
            <td>No Comments Found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection