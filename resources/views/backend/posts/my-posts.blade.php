@extends('layouts.app')
@section('content')
  <h1>My Posts</h1>
  @if($posts->isEmpty())
    <p>You haven't created any post yet.</p>
  @else
    @foreach ($posts as $post)
      <div class="card-mb-3">
        <div class="card-body">
          <h4>{{ $post->title }}</h4>
          <p>{{ $post->title }}</p>
        </div>
      </div>

    @endforeach
  @endif
@endsection