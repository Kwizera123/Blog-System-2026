@extends('layouts.home')

@section('content')

  <div class="container">

    <div class="text-center mb-5">

      <h1>
        {{ $contact->title }}
      </h1>

      <p class="lead">
        {{ $contact->introduction }}
      </p>

    </div>


    <div class="row">

      <div class="col-md-8 mx-auto">

        <div class="card">

          <div class="card-body">

            <h2 class="tutorial-card-title mb-4">
              Contact Information
            </h2>

            <p>
              <strong>Email:</strong>
              {{ $contact->email }}
            </p>

            @if ($contact->phone)

              <p>
                <strong>Phone:</strong>
                {{ $contact->phone }}
              </p>

            @endif

            @if ($contact->address)

              <p>
                <strong>Address:</strong>
                {{ $contact->address }}
              </p>

            @endif

          </div>

        </div>

      </div>

    </div>

  </div>

@endsection