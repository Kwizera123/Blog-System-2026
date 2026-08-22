@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <h1 class="mb-4">
      ✏️ Edit About Page
    </h1>

    <form action="{{ route('admin.about.update') }}" method="POST">

      @csrf

      @method('PUT')

      <div class="mb-3">

        <label for="title" class="form-label">
          About Page Title
        </label>

        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $about->title) }}"
          required>

      </div>


      <div class="mb-3">

        <label for="introduction" class="form-label">
          Introduction
        </label>

        <textarea name="introduction" id="introduction" rows="6" class="form-control"
          required>{{ old('introduction', $about->introduction) }}</textarea>

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