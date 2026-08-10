@extends('layouts.home')

@section('content')
  <div class="container">

    <article>

      <h1 class="mb-3">
        {{ $tutorial->title }}
      </h1>

      <p class="text-muted">
        By {{ $tutorial->user->name }}
        .{{ $tutorial->created_at->diffForHumans() }}
      </p>

      @if($tutorial->category)
        <span class="badge bg-secondary mb-3">
          {{ $tutorial->category->name }}
        </span>
      @endif

      @if ($tutorial->image)
        <div class="mb-4">
          <img src="{{ asset('storage/' . $tutorial->image) }}" alt="{{ $tutorial->title }}" class="img-fluid rounded">
        </div>
      @endif

      <div class="tutorial-content">
        {!! $tutorial->content !!}
      </div>

      @if ($tutorial->video_url)

        @php
          $videoUrl = $tutorial->video_url;

          if (str_contains($videoUrl, 'youtu.be/')) {
            $videoId = explode('youtu.be/', $videoUrl)[1];
            $videoId = explode('?', $videoId)[0];
          } elseif (str_contains($videoUrl, 'youtube.com/watch?v=')) {
            $videoId = explode('v=', $videoUrl)[1];
            $videoId = explode('&', $videoId)[0];
          } else {
            $videoId = null;
          }

        @endphp

        @if($videoId)
          <div class="mt-4">
            <h3 class="mb-3">Tutorial Video</h3>

            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="{{ $tutorial->title }}"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
              </iframe>

            </div>
          </div>
        @endif

      @endif

    </article>
  </div>
@endsection