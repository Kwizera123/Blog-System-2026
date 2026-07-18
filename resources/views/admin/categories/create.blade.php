@extends('layouts.app')
@section('content')
  <div class="container">
    <h1 class="text-primary">Create Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3 mt-4 col-4">
        <label for="">Category Name</label>
        <input type="text" name="name" class="form-control mt-2" placeholder="Category Name" value="{{ old('name') }}">
      </div>
      <button type="submit" class="btn btn-sm btn-primary">Create Category</button>
    </form>

  </div>
@endsection