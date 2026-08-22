@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <h1 class="mb-4">
      ✏️ Edit About Section
    </h1>

    <form action="{{ route('admin.about.items.update', $aboutItem) }}" method="POST">

      @csrf

      @method('PUT')

      <div class="mb-3">

        <label for="section" class="form-label">
          Section Title
        </label>

        <input type="text" name="section" id="section" class="form-control"
          value="{{ old('section', $aboutItem->section) }}" required>

      </div>


      <div class="mb-3">

        <label for="content" class="form-label">
          Section Content
        </label>

        <textarea name="content" id="content" rows="8" class="form-control"
          required>{{ old('content', $aboutItem->content) }}</textarea>

      </div>


      <div class="mb-3">

        <label for="sort_order" class="form-label">
          Sort Order
        </label>

        <input type="number" name="sort_order" id="sort_order" class="form-control"
          value="{{ old('sort_order', $aboutItem->sort_order) }}" min="1" required>

      </div>


      <button type="submit" class="btn btn-primary">
        💾 Save Changes
      </button>

      <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">
        Cancel
      </a>

    </form>

  </div>

@endsection