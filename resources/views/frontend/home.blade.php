{{-- @php use Illuminate\Support\Str; @endphp --}}
@extends('layouts.frontend')

@section('content')
  <div class="container mt-4">

    <h1 class="mb-4">Latest Posts</h1>
    <div class="row">

      @foreach ($posts as $post)

        <div class="card mb-2" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail mt-1 img-fluid rounded-start"
                  alt="{{ $post->title }}" width="120" height="">
                @else
                <span class="text-muted">No Image</span>
              @endif

            </div>
            <div class="col-md-10">
              <div class="card-body">
                <h5 class="card-title"> {{ $post->title }}</h5>
                <p class="card-text"><small class="text-body-secondary">Category: {{ $post->category->name }}</small></p>
                <p class="card-text">{{ Str::limit($post->content, 120) }}</p>
                <p class="card-text"><small class="text-body-secondary"> By: {{ $post->user->name }}</small></p>
                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm">Read
                  More</a>
              </div>
            </div>
          </div>
        </div>



      @endforeach
    </div>
  </div>
@endsection