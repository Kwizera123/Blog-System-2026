@extends('layouts.home')

@section('content')

  <div class="container">

    <h1 class="mb-4 mt-0"><strong>📚 Tutorials</strong>
    </h1>

    <p class="text-muted mb-3">
      Learn web development through step-by-step tutorials.
    </p>

    @forelse ($tutorials as $tutorial)

      <article class="card mb-4 shadow-sm">

        @if($tutorial->image)
          <img src="{{ asset('storage/' . $tutorial->image) }}" class="card-img-top" alt="{{ $tutorial->title }}"
            style="max-height: 300px; object-fit: cover;">
        @endif

        <div class="card-body">

          <h2 class="h4">
            {{ $tutorial->title }}
          </h2>

          <p class="text-muted mb-2">

            By {{ $tutorial->user->name }}
            .
            {{ $tutorial->created_at->diffForHumans() }}

          </p>
          @if($tutorial->category)
            <span class="badge bg-secondary mb-3">
              {{ $tutorial->category->name }}
            </span>
          @endif
          <p>
            {{ Str::limit(strip_tags($tutorial->content), 180) }}
          </p>

          <a href="{{ route('tutorials.show', $tutorial) }}" class="btn btn-sm btn-primary mt-2">Read Tutorial</a>

        </div>

      </article>

    @empty

      <div class="alert alert-info">
        No published tutorials found.
      </div>

    @endforelse

    {{ $tutorials->links() }}

  </div>

@endsection