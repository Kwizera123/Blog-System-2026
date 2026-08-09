@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h1><strong>📚 Create Tutorial</strong></h1>

    <p class="text-muted mt-3 mb-3">
      Create a new tutorial for your website.
    </p>
    <form action="{{ route('admin.tutorials.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Title--}}
      <div class="mb-3">
        <label for="title" class="form-label">Tutorial Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title') }}" placeholder="Enter tutorial title">

        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

      </div>

      {{-- Category --}}
      <div class="mb-3">

        <label for="category_id" class="form-label">
          Category
        </label>

        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
          <option value="">Select Category</option>

          @foreach ($categories as $category)

            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>

          @endforeach
        </select>

        @error('category_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Content --}}
      <div class="mb-3">
        <label for="content" class="form-label">
          Tutorial Content
        </label>

        <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror"
          placeholder="Write your tutorial content here...">{{ old('content') }}</textarea>

        @error('content')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Image --}}
      <div class="mb-3">

        <label for="image" class="form-label">
          Tutorial Image
        </label>

        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Video URL --}}
      <div class="mb-3">

        <label for="video_url" class="form-label">
          Video URL
        </label>

        <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror"
          value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">

        @error('video_url')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Status --}}
      <div class="mb-3">

        <label for="status" class="form-label">
          Status
        </label>

        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">

          <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
            Draft
          </option>

          <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
            Published
          </option>

        </select>


        @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

      </div>

      <button type="submit" class="btn btn-primary">
        Create Tutorial
      </button>

      <a href="{{ route('admin.tutorials.index') }}" class="btn btn-secondary">
        Cancel
      </a>



    </form>
  </div>
@endsection