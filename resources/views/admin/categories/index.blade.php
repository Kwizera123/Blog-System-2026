@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="table-responsive mt-4">
      <h1>
        Category Page
      </h1>

      <table class="table table-striped align-middle">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary mt-3">Create Category</a>
        <form action="{{ route('admin.categories.index') }}" method="GET" class="mb-3">
          <div class="input-group mt-2">
            <input type="text" name="search" class="form-control" placeholder="Search category..."
              value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
          </div>
        </form>
        <thead>
          <tr>
            <th>#</th>
            <th>Category</th>
            <th>Post</th>
            <th>Created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $totalPosts }}</td>
              <td>{{ $category->created_at->diffForHumans() }}</td>
              <td>
                <a href="#" class="btn btn-sm btn-warning">View</a>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-success">Update</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger"
                    onclick="return confirm('Are You sure you want to delete this category?' )">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <p>
              No Category Found!
            </p>
          @endforelse
        </tbody>
      </table>

    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">Back</a>
    {{ $categories->links() }}
  </div>
@endsection