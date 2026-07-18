@extends('layouts.app')
@section('content')
  <div class="container">
    <h1 class="text-primary">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-3 mt-4 col-4">
        <label for="">Category Name</label>
        <input type="text" name="name" class="form-control mt-2" placeholder="Update Category Name"
          value="{{ old('name', $category->name) }}">
      </div>
      <button type="submit" class="btn btn-sm btn-success">Update Category</button>
      <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-danger">Cancel</a>
    </form>

  </div>
@endsection