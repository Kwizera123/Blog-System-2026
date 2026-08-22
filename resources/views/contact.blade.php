@extends('layouts.home')

@section('content')





  <div class="container">

    <div class="text-center mb-2">

      <h1>
        {{ $contact->title }}
      </h1>

      <p class="lead">
        {{ $contact->introduction }}
      </p>

    </div>


    <div class="row">

      <div class="col-md-12 mx-auto">

        <div class="card mb-2">

          <div class="card-body">

            <h2 class="tutorial-card-title mb-2">
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
        @if (session('success'))

          <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>

          </div>

        @endif

        <div class="row mt-0">

          <div class="col-md-12 mx-auto">

            <div class="card">

              <div class="card-body">

                <h2 class="tutorial-card-title mb-4">
                  Send Us a Message
                </h2>

                <form action="{{ route('contact.store') }}" method="POST">

                  @csrf

                  <div class="mb-3">

                    <label for="name" class="form-label">
                      Name
                    </label>

                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>

                  </div>


                  <div class="mb-3">

                    <label for="email" class="form-label">
                      Email
                    </label>

                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>

                  </div>


                  <div class="mb-3">

                    <label for="subject" class="form-label">
                      Subject
                    </label>

                    <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}"
                      required>

                  </div>


                  <div class="mb-3">

                    <label for="message" class="form-label">
                      Message
                    </label>

                    <textarea name="message" id="message" rows="7" class="form-control"
                      required>{{ old('message') }}</textarea>

                  </div>


                  <button type="submit" class="btn btn-primary">
                    📩 Send Message
                  </button>

                </form>

              </div>

            </div>

          </div>

        </div>

      </div>



    </div>

  </div>



@endsection