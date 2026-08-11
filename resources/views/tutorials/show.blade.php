@extends('layouts.home')

@section('content')
  <div class="container">

    <article>

      <h1 class="mb-3">
        {{ $tutorial->title }}
      </h1>

      <p class="text-muted">
        By {{ $tutorial->user->name }}.
        <small><strong>{{ $tutorial->created_at->diffForHumans() }}</strong>
        </small>
      </p>
      <!--Category-->
      @if($tutorial->category)
        <span class="badge bg-secondary mb-3">
          {{ $tutorial->category->name }}
        </span>
      @endif
      <!--Tags-->

      @if ($tutorial->tags->isNotEmpty())
        <div class="mb-3">
          <strong>Tags:</strong>
          @foreach ($tutorial->tags as $tag)

            <a href="{{ route('tutorials.index', ['tag' => $tag->id]) }}" class="badge bg-primary text-decoration-none me-1">
              {{ $tag->name }}
            </a>
          @endforeach
        </div>
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
    {{-- -Previous / Next Tutorial navigation--}}

    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
      <!--Previous Tutorial.  -->
      <div>
        @if ($previousTutorial)
          <a href="{{ route('tutorials.show', $previousTutorial) }}" class="btn btn-sm btn-outline-primary">
            ← Previous Tutorial
          </a>
        @endif
      </div>

      {{-- Next Tutorial--}}
      <div>
        @if($nextTutorial)
          <a href="{{ route('tutorials.show', $nextTutorial) }}" class="btn btn-sm btn-outline-success">
            Next Tutorial →
          </a>
        @endif
      </div>
    </div>

  </div>
@endsection