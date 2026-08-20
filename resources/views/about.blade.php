@extends('layouts.home')

@section('content')

  <div class="container">

    <div class="text-center mb-5">
      <h1>About CodingLearners</h1>

      <p class="lead">
        Learn. Build. Grow.
      </p>
    </div>

    <div class="row">

      <div class="col-md-12 mx-auto">

        <h2>Who We Are</h2>

        <p>
          CodingLearners is a platform created to help people
          learn web development through practical tutorials,
          examples, and real-world projects.
        </p>
        <br>
        <p>
          Our goal is to make programming easier to understand
          by explaining concepts step by step and allowing
          learners to practice what they learn.
        </p>
        <div class="mt-4">
          <h2>What We Teach</h2>

          <p>
            We focus on technologies and skills that are useful
            for modern web development, including:
          </p>
          <br>
          <p>
            CodingLearners.com also focuses on practical web development skills
            that help learners understand how modern websites and web
            applications are built.
          </p>

          <ul>
            <li>HTML and CSS</li>
            <li>JavaScript</li>
            <li>PHP and MySQL</li>
            <li>Laravel Framework</li>
            <li>Building real-world web applications</li>
          </ul>

        </div>
        <div class="mt-5">
          <h2>Our Mission</h2>
          <br>
          <p>
            Our mission is to help beginners become confident
            developers by providing clear explanations,
            practical examples, and projects they can build
            themselves.
          </p>
          <br>
          <p>
            We also make web development
            easier to understand by providing practical, step-by-step
            tutorials for aspiring developers.
          </p>
          <br>
          <p>
            We believe that anyone who is willing to learn and practice
            can develop the skills needed to build real-world websites
            and web applications.
          </p>
        </div>

        <div class="mt-5 mb-2">
          <h2>Who This Website Is For</h2>

          <p>
            CodingLearners.com is designed for anyone who wants to learn
            web development and improve their programming skills through
            practical examples and step-by-step tutorials.
          </p>

          <ul>
            <li>Complete beginners who are starting their coding journey</li>
            <li>Students learning web development</li>
            <li>Developers improving their PHP and Laravel skills</li>
            <li>Anyone interested in building websites and web applications</li>
          </ul>
        </div>
        <hr>
        <div class="mt-3">
          <h2>Why Learn With Us</h2>

          <p>
            Learning to code is easier when you have clear explanations,
            practical examples, and a structured path to follow.
            CodingLearners.com is built to provide exactly that.
          </p>

          <ul>
            <li>Step-by-step tutorials that are easy to follow</li>
            <li>Practical coding examples</li>
            <li>Real-world web development projects</li>
            <li>Lessons designed to build your skills gradually</li>
            <li>Resources for both beginners and growing developers</li>
          </ul>
        </div>

        <div class="mt-5 mb-5">
          <h2>Start Learning Today</h2>

          <p>
            Ready to start your web development journey?
            Explore our tutorials and begin building your coding skills
            step by step.
          </p>

          <a href="{{ route('tutorials.index') }}" class="btn btn-primary">
            📚 Explore Tutorials
          </a>
        </div>

      </div>

    </div>

  </div>

@endsection