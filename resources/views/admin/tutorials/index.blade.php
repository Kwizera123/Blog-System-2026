@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h1><strong>📚 Tutorial Management</strong></h1>
    <p class="text-muted mt-2">
      Manage your tutorials from the admin panel.
    </p>
    <div class="d-flex justify-content-between">
      <a href="{{ route('admin.tutorials.create') }}" class="btn btn-sm btn-primary mb-3 mt-3">
        <i class="bi bi-pencil-fill"></i> Create Tutorial
      </a>

      <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary mb-3 mt-3">
        <i class="bi bi-speedometer"></i> Dashboard
      </a>
    </div>
    @if ($tutorials->isEmpty())
      <div class="alert alert-info">
        No tutorials have been created yet.
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Author</th>
              <th>Category</th>
              <th>Status</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tutorials as $tutorial)
              <tr>
                <td>{{ $tutorials->firstItem() + $loop->index}}</td>
                <td>{{ $tutorial->title }}</td>
                <td>{{ $tutorial->user->name }}</td>
                <td>{{ $tutorial->category->name }}</td>
                <td>{{ $tutorial->status }}</td>
                <td>{{ $tutorial->created_at->diffForHumans() }}</td>
                <td>
                  <a href="{{ route('admin.tutorials.edit', $tutorial) }}" class="btn btn-sm btn-success">
                    Edit
                  </a>
                  <form action="{{ route('admin.tutorials.destroy', $tutorial) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this tutorial?');">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                      🗑️ Delete
                    </button>
                  </form>
                </td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>
      {{ $tutorials->links() }}
    @endif
  </div>
@endsection