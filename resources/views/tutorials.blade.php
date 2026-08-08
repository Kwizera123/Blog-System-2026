@extends('layouts.home')

@section('content')

  <div class="container">

    <h1 class="mb-4 mt-4">📚 Tutorials</h1>

    <p class="text-muted">
      Learn web development through step-by-step tutorials.
    </p>

    @forelse ($tutorials as $tutorial)

      <article class="card mb-4 shadow-sm">

        <div class="card-body">

          <h2 class="h4">
            {{ $tutorial->title }}
          </h2>

          <p class="text-muted mb-2">

            By {{ $tutorial->user->name }}

            ·

            {{ $tutorial->created_at->diffForHumans() }}

          </p>

          <p>
            {{ Str::limit(strip_tags($tutorial->content), 180) }}
          </p>

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