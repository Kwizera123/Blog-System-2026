@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <h1 class="mb-4">
      <i class="bi bi-file-earmark-plus-fill"></i> Add About Section
    </h1>

    <form action="{{ route('admin.about.items.store') }}" method="POST">

      @csrf

      <div class="mb-3">

        <label for="section" class="form-label">
          Section Title
        </label>

        <input type="text" name="section" id="section" class="form-control" value="{{ old('section') }}" required>

      </div>


      <div class="mb-3">

        <label for="content" class="form-label">
          Section Content
        </label>

        <textarea name="content" id="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>

      </div>


      <button type="submit" class="btn btn-primary">
        💾 Save Section
      </button>

      <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">
        Cancel
      </a>

    </form>

  </div>

@endsection