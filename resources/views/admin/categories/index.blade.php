@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="table-responsive mt-4">
      <h1>
        Category Page
      </h1>

      <div class="row mt-4">

        <div class="col-md-3">
          <div class="card text-center alert alert-warning shadow-sm">
            <div class="card-body">
              <h5>🗂️ <strong>Total Categories:</strong> </h5>
              {{ $totalCategories }}
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-center shadow-sm alert alert-primary">
            <div class="card-body">
              <h5 class="fade show">📝 <strong>Total Post:</strong></h5>
              {{ $totalPosts }}
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-center shadow-sm alert alert-success" role="alert">
            <div class=" card-body">

              <h2 class="alert-heading  fade show"><strong>Largest Category:</strong></h2>

              <p class="text-body-emphasis">{{ $largestCategory->name }}</p>

            </div>
          </div>
        </div>



        <div class="col-md-3">
          <div class="card text-center alert alert-info shadow-sm">
            <div class="card-body">
              <h5>💬<strong>Posts </strong></h5>

              {{ $largestCategory->posts_count }}
            </div>
          </div>
        </div>



      </div>

      <hr class="my-4">

      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary mt-3">Create Category</a>

          <p class="text-muted mt-2">
            showing {{ $categories->count() }} of {{ $categories->total() }} categories.
          </p>

          <form action="{{ route('admin.categories.index') }}" method="GET" class="mb-3">
            <div class="input-group mt-2">
              <input type="text" name="search" class="form-control" placeholder="Search category by name..."
                value="{{ request('search') }}">
              <button class="btn btn-primary">Search</button>
            </div>
          </form>
          @if($categories->isEmpty())

            <div class="alert alert-info">
              No categories found
            </div>
          @else

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
                  <td>{{ $category->posts_count }}</td>
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
          @endif
        </table>
      </div>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">Back</a>
    {{ $categories->links() }}
  </div>
@endsection