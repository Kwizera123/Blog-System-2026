@extends('layouts.app')
@section('content')
  <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

      <h2 class="text-success">
        All Tags
      </h2>
      <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-primary">+ Create Tag</a>
    </div>

    @if(session('success'))

      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if($tags->count() > 0)
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>ID</td>
            <td>Tag Name</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($tags as $tag)
            <tr>

              <td>{{ $tags->firstItem() + $loop->index }}</td>
              <td>{{ $tag->name }}</td>
              <td>
                <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        {{ $tags->links() }}
      </div>
    @else
      <div class="alert alert-info">
        No tags have been created yet.
      </div>
    @endif
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">
      Back to Dashboard
    </a>
    <br>
@endsection