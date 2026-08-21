@extends('layouts.home')

@section('content')

  <div class="container">

    <div class="text-center mb-5">
      <h1>{{ $about->title }}</h1>

      <p class="lead">
        Learn. Build. Grow.
      </p>
    </div>

    <div class="row">

      <div class="col-md-12 mx-auto">

        <h1 class="tutorial-card-title">Who We Are</h1>

        <p>
          {{ $about->introduction }}
        </p>

        <div class="mt-4">
          <h2 class="tutorial-card-title">{{ $about->mission_title }}</h2>
          <p>
            {{ $about->mission_content }}
          </p>
        </div>


        <div class="mt-4">
          <h2 class="tutorial-card-title">{{ $about->teaching_title }}</h2>

          <p>
            {{ $about->teaching_content }}
          </p>
          <p class="mt-3">
            We focus on technologies and skills that are useful
            for modern web development, including:
          </p>
          <ul>
            <li>HTML and CSS</li>
            <li>JavaScript</li>
            <li>PHP and MySQL</li>
            <li>Laravel Framework</li>
            <li>Building real-world web applications</li>
          </ul>

        </div>


        <div class="mt-3 mb-2">
          <h2 class="tutorial-card-title">{{ $about->audience_title }}</h2>

          <p>
            {{ $about->audience_content }}

          </p>
        </div>

        <div class="mt-4">
          <h2 class="tutorial-card-title">{{ $about->why_learn_title }}</h2>

          <p>
            {{ $about->why_learn_content }}
            {{-- Learning to code is easier when you have clear explanations,
            practical examples, and a structured path to follow.
            CodingLearners.com is built to provide exactly that. --}}
          </p>

          {{-- <ul>
            <li>Step-by-step tutorials that are easy to follow</li>
            <li>Practical coding examples</li>
            <li>Real-world web development projects</li>
            <li>Lessons designed to build your skills gradually</li>
            <li>Resources for both beginners and growing developers</li>
          </ul> --}}
        </div>

        <div class="mt-4">
          <h2 class="tutorial-card-title"> {{ $about->cta_title }}</h2>

          <p class="mb-2">
            {{ $about->cta_content }}
          </p>

          <a href="{{ route('tutorials.index') }}" class="btn btn-primary">
            📚 Explore Tutorials
          </a>
        </div>

      </div>

    </div>
</div>@endsection