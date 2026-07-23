@extends('layouts.frontend')

@section('content')

  <div class="container mt-4">
    <labe class="form-label text text-primary">
      <strong>Your Post:</strong>
    </labe>
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
        @if($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}" width="200">
        @endif



        {{-- @if($post->video_url)
        <div class="me">
          @php
          $embedUrl = $post->video_url;

          if (str_contains($embedUrl, 'watch?v=')) {
          $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
          }

          if (str_contains($embedUrl, 'youtu.be/')) {
          $embedUrl = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $embedUrl);
          }
          @endphp

          <div class="ratio ratio-16x9 mb-2">

            <iframe class="object-fit-cover border rounded" src="{{ $embedUrl }}" title="{{ $post->title }}"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
          </div>

        </div>
        @else
        <div class="text-mutes">
          No Video found
        </div>
        @endif --}}

        @if($post->embed_video_url)

          <iframe src="{{ $post->embed_video_url }}"></iframe>

        @endif
      </div>
    </div>
    {{-- Comment--}}

    @auth
      <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="mb-3">
          <labe class="form-label">Leave a Comment:</labe>
          <textarea name="comment" class="form-control" id="" rows="3" required></textarea>
        </div>
        <button class="btn btn-primary">Send Comment</button>
      </form>
    @endauth

    <h3 class="mt-3">
      Comments({{ $post->comments->count() }})
    </h3>

    @forelse ($post->comments as $comment)


      <div class="card mb-3">
        <div class="card-body">
          <h6>
            {{ $comment->user->name }}
          </h6>
          <small class="text-muted">
            {{ $comment->created_at->diffForHumans() }}
          </small>
          <p class="mt-1">
            {{ $comment->comment }}
          </p>
          {{--Edit andDelete Buttons--}}
          {{-- @if(auth()->check() && auth()->id() == $comment->user_id) --}}
          @can('update', $comment)
            <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-warning">Edit</a>
          @endcan
          @can('delete', $comment)
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">
                Delete
              </button>
            </form>
          @endcan
        </div>

      </div>
    @empty
      <p>Not Comment yet,</p>
    @endforelse
    {{--
    @endforeach --}}


    <a href="/home" class="btn btn-secondary mt-3">
      ← Back
    </a>
  </div>
@endsection