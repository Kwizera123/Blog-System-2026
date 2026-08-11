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

          <div class="row mt-3">
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
            <div class="col-md-2">
              <button type="submit" class="btn btn-sm btn-secondary w-100"><i class="bi bi-funnel"></i> Filter</button>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-sm btn-primary w-100"><i class="bi bi-search"></i> Search</button>
        </div>

        <div class="col-md-3 mt-2 mt-md-2">
          <a href="{{ route('tutorials.index') }}" class="btn btn-sm btn-secondary w-100"><i
              class="bi bi-funnel"></i>Clear Filter</a>
        </div>



      </div>
    </form>
    {{-- --}}

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

          <p class="text-muted mb-0">

            By {{ $tutorial->user->name }}.
            <small><strong>{{ $tutorial->created_at->diffForHumans() }}</strong></small>
          </p>
          @if($tutorial->category)
            <span class="badge bg-secondary mb-2">
              {{ $tutorial->category->name }}
            </span>
          @endif
          <p> {{ Str::limit(strip_tags($tutorial->content), 180) }}
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

</div>@endsection