@extends('layouts.home')

@section('content')

  @php
    use App\Helpers\TutorialContentHelper;
  @endphp
  <div class="container mt-4">
    <labe class="form-label text text-primary">
      <strong>The Post | Reading</strong>
    </labe>

    <div class="card bg-light border-0">
      @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img" alt="{{ $post->title }}">
      @endif
    </div>

    <div class="card border-0">

      <div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>

        <p class="text-muted">
          Written By: <strong> {{ $post->user->name }}</strong>
          |
          Category: <strong>{{ $post->category->name }}</strong>
          |
          {{ $post->created_at->format('M d, Y') }}
          |
          @if($post->tags->count())

            <div class="mt-2">

              <strong>Tags:</strong>

              @foreach ($post->tags as $tag)

                <span class="badge bg-info">{{ $tag->name }}</span>

              @endforeach

            </div>

          @endif


        </p>
        <hr class="mt-2 mb-2 h-r">

        <div class="post-content tutorial-content blog-article-content">

          {{-- {!! $post->content !!} --}}
          {!! TutorialContentHelper::render($post->content) !!}

        </div>




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
          <hr class="mb-2 h-r">
          <h3>Video Tutorial</h3>
          <div class="ratio ratio-16x9 mt-2">
            <iframe src="{{ $post->embed_video_url}}" allowfullscreen>
            </iframe>
          </div>
        @endif
      </div>
    </div>
    {{-- Comment section--}}
    <div class="mt-3">
      <h3 class="mb-1">
        Comments
        <span class="badge bg-secondary mt-2 mb-2">
          {{ $post->comments->count() }}
        </span>
      </h3>
      @forelse ($post->comments as $comment)
        <div class="card mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <strong>
                {{ $comment->user->name }}
              </strong>
              <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
              </small>
            </div>
            <p class="mt-2 mb-0">
              {{ $comment->comment }}
            </p>
          </div>

          @can('update', $comment)
            <div class="justify-content-between mb-2 ml-3">
              <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-warning">Edit</a>

              <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this comment?')">
                  Delete
                </button>
              </form>
            </div>
          @endcan
        </div>

      @empty
        <div class="alert alert-light border">
          No comments yet.
          Be the first personto comment!
        </div>
      @endforelse
    </div>

    {{-- Comment Form --}}


    @if(session('success'))
      <div class="alert alert-success d-flex align-items-center" role="alert">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card mt-3 mb-4">
      <div class="card-body">
        <h4 class="mb-3">
          Leave a Comment
        </h4>
        @auth
          <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            {{-- connect the comment to this post --}}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
              <label for="comment" class="form-label">Your Comment</label>
              <textarea name="comment" id="comment" cols="30" rows="4" class="form-control"
                placeholder="Write your comment here...">
                                                                                                                                                                                                                                                                                                                                                                                                             {{ old('comment') }}
                                                                                                                                                                                                                                                                                                                                                                                                  </textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">
              Send Comment
            </button>
          </form>
        @else
          <div class="alert alert-info mb-0">
            Please <a href="{{ route('login') }}">login</a> to leave a comment.
          </div>
        @endauth
      </div>
    </div>



    {{-- <h3 class="mt-3">
      Comments({{ $post->comments->count() }})
    </h3> --}}
    {{--
    @forelse ($post->comments as $comment)


    <div class="card mb-3 border-bottom ">
      <div class="card-body">
        <h6>
          {{ $comment->user->name }}
        </h6>
        <small class="text-muted">
          {{ $comment->created_at->diffForHumans() }}
        </small>

        {{--Edit andDelete Buttons--}}
        {{-- @if(auth()->check() && auth()->id() == $comment->user_id) --}}
        {{-- @can('update', $comment)
        <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-warning">Edit</a>
        @endcan --}}
        {{-- @can('delete', $comment)
        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger">
            Delete
          </button>
        </form>
        @endcan --}}
        {{--
      </div>

    </div> --}}
    {{-- @empty
    <p>Not Comment yet,</p>
    @endforelse --}}
    {{--
    @endforeach --}}


    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm mt-3">
      ← Back
    </a>
  </div>
@endsection