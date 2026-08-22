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

        @foreach ($about->aboutItems->sortBy('sort_order') as $item)

          <div class="mt-4">

            <h2 class="tutorial-card-title">
              {{ $item->section }}
            </h2>

            <p>
              {{ $item->content }}
            </p>

            {{-- Special content for What We Teach --}}

            @if ($item->section === 'What We Teach')

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

            @endif

          </div>

        @endforeach


        {{-- Call To Action --}}

        <div class="mt-4">

          <a href="{{ route('tutorials.index') }}" class="btn btn-primary">

            📚 Explore Tutorials

          </a>

        </div>

      </div>

    </div>

  </div>

@endsection