@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2>Create New Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Category</label>

        <select name="category_id" class="form-select">
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->name }}
            </option>
          @endforeach
        </select>

        <div class="mb-3">
          <label for="" class="form-label">Content</label>
          <textarea name="content" rows="6" class="form-control" id="">
                                                                                                                                                                                                                                                                                                                                                                                                                         {{ old('content') }}
                                                                                                                                                                                                                                                                                                                                                                                                                     </textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Featured Image</label>
          <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
          <label for="" class="control-label"><span class="text text-danger">YouTube</span> Video URL</label>
          <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}"
            placeholder="https://www.youtube.com/watch?=...">
          <small class="text-muted">
            Optional. Paste a YouTube video link.
          </small>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Status</label>
          <select name="status" id="" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>
        </div>

        <button class="btn btn-primary">Publish Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
    </form>
  </div>
@endsection