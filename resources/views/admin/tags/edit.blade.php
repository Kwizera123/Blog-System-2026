@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2 class="text-success mb-4">
      Edit Tag
    </h2>
    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name', $tag->name) }}" required>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-sm btn-success">Update Tag</button>
      <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </form>
  </div>
@endsection