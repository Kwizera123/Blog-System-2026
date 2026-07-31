@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2 class="text-success mb-4">
      create New Tag
    </h2>
    <form action="{{  route('admin.tags.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">
          Tag Name
        </label>
        <input name="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name') }}" placeholder="Example: Laravel" required>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
        @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Save Tag</button>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-secondary">Back</a>
      </div>
    </form>
  </div>
@endsection