@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <h1 class="mb-4">
      📚 Manage About Page
    </h1>

    <div class="card mb-4">

      <div class="card-body">

        <h2>
          {{ $about->title }}
        </h2>

        <p class="text-muted">
          {{ $about->introduction }}
        </p>
        <small class="text-muted d-block mb-2">
          Appeared on About Page!
        </small>
        <a href="{{ route('admin.about.edit', $about) }}" class="btn btn-primary btn-sm">
          ✏️ Edit
        </a>

      </div>

    </div>


    <h3 class="mb-3">
      About Sections
    </h3>

    <a href="{{ route('admin.about.items.create') }}" class="btn btn-success mb-3">
      <i class="bi bi-check2-all"></i> <i class="bi bi-file-earmark-plus-fill"></i> Add About Section
    </a>

    @foreach ($about->aboutItems->sortBy('sort_order') as $item)

      <div class="card mb-3">

        <div class="card-body">

          <h4>
            {{ $item->section }}
          </h4>

          <p>
            {{ $item->content }}
          </p>

          <small class="text-muted d-block mb-2">
            Sort Order: {{ $item->sort_order }}
          </small>

          <a href="{{ route('admin.about.items.edit', $item) }}" class="btn btn-primary btn-sm">
            ✏️ Edit
          </a>

          <form action="{{ route('admin.about.items.destroy', $item) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Are you sure you want to delete this section?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
              🗑️ Delete
            </button>
          </form>

        </div>

      </div>

    @endforeach

  </div>

@endsection