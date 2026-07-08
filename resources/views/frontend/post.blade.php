@extends('layouts.app')

@section('content')
  <div class="container mt-4">

    <div class="card">

      <div class="card-body">
        <h2>{{ $post->title }}</h2>
        <p class="text-muted">
          By: {{ $post->user->name }} | Category: {{ $post->category->name }}
        </p>
        <hr>
        <p>
          {{ $post->content }}
        </p>
      </div>
    </div>
    <a href="/home" class="btn btn-secondary mt-3">
      ← Back
    </a>
  </div>
@endsection