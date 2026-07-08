@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
  <div class="container mt-4">

    <h1 class="mb-4">Latest Posts</h1>
    <div class="row">

      @foreach ($posts as $post)
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">

              <h4 class="card-title">
                {{ $post->title }}
              </h4>
              <p class="text-muted mb-1">
                By: {{ $post->user->name }}
              </p>
              <p class="text-muted">
                Category: {{ $post->category->name }}
              </p>
              <p>
                {{ Str::limit($post->content, 120) }}
              </p>

              <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm">Read More</a>
              <hr>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection