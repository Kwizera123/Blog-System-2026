@extends('layouts.user-profile')
@section('content')


  <!-- Main Content Area -->


  <div class="container mt-5">

    <div class="row justify-content-center">

      <div class="col-md-8">

        <div class="card shadow-sm">

          <div class="card-header">

            <h3 class="mb-0">
              My Profile
            </h3>

          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success mt-3">
                {{ session('success') }}
              </div>
            @endif
            @if (session('error'))
              <div class="alert alert-danger mt-3">
                {{ session('error') }}
              </div>
            @endif

            <form action="{{ route('blogprofile.update') }}" method="POST">
              @csrf
              @method('PATCH')
              <div class="mb-3">

                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name', $user->name) }}">

                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">

                <label for="email" class="form-label">Email:</label>

                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                  value="{{ old('email', $user->email) }}">

                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <button type="submit" class="btn btn-sm btn-success">Update Profile</button>
              {{-- <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a> --}}
            </form>

            <div class="mb-3 mt-2">
              <strong>Member Since:</strong>

              <p class="mb-0">
                {{ $user->created_at->format('F d, Y') }}
              </p>

            </div>

            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
              Back
            </a>

          </div>

        </div>

      </div>

    </div>
  </div>


@endsection