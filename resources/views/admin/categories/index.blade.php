@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="table-responsive mt-4">
      <h1>
        Category Page
      </h1>
      <table class="table table-striped align-middle">
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
              <td>{{ $category->post }}</td>
              <td>{{ $category->created_at->diffForHumans() }}</td>
              <td>
                <a href="#" class="btn btn-sm btn-warning">View</a>
                <a href="#" class="btn btn-sm btn-success">Update</a>
                <a href="#" class="btn btn-sm btn-danger">Delete</a>
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