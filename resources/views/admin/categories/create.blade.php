@extends('layouts.app')
@section('content')
  <div class="container">
    <h1 class="text-primary">Create Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3 mt-4 col-4">
        <label for="">Category Name</label>
        <input type="text" name="name" class="form-control mt-2 @error('name') is-invalid @enderror"
          placeholder="Category Name" value="{{ old('name') }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-sm btn-primary" id="submitBtn"><i class="bi bi-save"></i> Create
        Category</button>
      <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i>
        Cancel</a>
    </form>

  </div>

@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');

    if (form && submitBtn) {

      form.addEventListener('submit', function () {

        submitBtn.disabled = true;
        submitBtn.innerHTML = '⏳ Saving...';

      });

    }

  });
</script>