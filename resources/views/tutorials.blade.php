@extends('layouts.home')

@section('content')

  <div class="container">
    <h1 class="mb-4 mt-0"><strong>📚 Tutorials</strong>
    </h1>

    <p class="text-muted mb-3">
      Learn web development through step-by-step tutorials.
    </p>
    {{-- Search--}}
    <form action="{{ route('tutorials.index') }}" method="GET" class="mb-4">
      <div class="row">
        <div class="col-md-10">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control"
            placeholder="Search tutorials...">

          <div class="row mt-2">
            <div class="col-md-10">
              <select name="category" id="category" class="form-control">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : ''}}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2 mt-1">
              <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-funnel"></i> Filter</button>
            </div>
          </div>
        </div>

        <div class="col-md-2 mt-1">
          <button type="submit" class="btn btn-sm btn-primary">Search</button>
        </div>

        <div class="col-md-3 mt-2 mt-md-2">
          <a href="{{ route('tutorials.index') }}" class="btn btn-sm btn-secondary">Clear
            Filter</a>
        </div>



      </div>
    </form>
    {{-- --}}
    @forelse ($tutorials as $tutorial)

      <article class="card tutorial-card mb-4 shadow-sm border-0">

        @if($tutorial->image)
          <img src="{{ asset('storage/' . $tutorial->image) }}" class="card-img-top tutorial-card-image"
            alt="{{ $tutorial->title }}" style="height: 240px; object-fit: cover;">
        @endif

        <div class="card-body p-4">

          <h1 class="h4 mb-2 tutorial-card-title">
            <a href="{{ route('tutorials.show', $tutorial) }}">
              {{ $tutorial->title }}
            </a>
          </h1>

          <p class="text-muted mb-4 tutorial-card-meta">

            By {{ $tutorial->user->name }}.
            <small><strong>{{ $tutorial->created_at->diffForHumans() }}</strong></small>
          </p>
          @if($tutorial->category)
            <span class="badge tutorial-category-badge mb-2">
              {{ $tutorial->category->name }}
            </span>
          @endif
          <p class="mb-3 tutorial-card-excerpt"> {{ Str::limit(strip_tags($tutorial->content), 180) }}
          </p>

          <a href="{{ route('tutorials.show', $tutorial) }}" class="btn btn-sm btn-primary tutorial-read-btn mt-2">Read
            Tutorial →</a>

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