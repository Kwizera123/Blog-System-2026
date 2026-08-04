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
            {{-- display the uploaded profile photo--}}
            @if ($user->profile_photo)

              <div class="text-left mb-4">

                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                  class="rounded-circle img-thumbnail" width="150" height="150" style="object-fit: cover;">

                {{-- Delete Photo--}}
                <form action="{{ route('blogprofile.photo.destroy') }}" method="POST" class="mt-2">
                  @csrf
                  @method('DELETE')

                  <button class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to remove your profile photo?')">
                    Remove Photo
                  </button>
                </form>

              </div>
            @else
                      {{-- <div class="text-center mb-4">
                        <img src="{{ asset('storage/user-profile.jpg') }}" alt="{{ $user->name }}"
                          class="rounded-circle img-thumbnail" width="150" height="150" style="object-fit: cover;">
                      </div> --}}

                      <div class="rounded-circle bg-secondary text-white d-inline-flex justify-content-center align-items-center"
                        style="width: 150px; height: 150px;font-size: 50px;">

                        {{ strtoupper(
                substr($user->name, 0, 1)
              ) }}
                      </div>

            @endif



            <form action="{{ route('blogprofile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PATCH')

              <div class="mb-3">
                <label for="profile_photo" class="form-label">Profile Photo</label>

                <input type="file" id="profile_photo" name="profile_photo"
                  class="form-control @error('profile_photo') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                <small class="text-muted">
                  JPG, JPEG, PNG, or WEBP.
                  Maximum size: 2 MB.
                </small>

                @error('profile_photo')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

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

            {{-- Password Update--}}
            <hr class="my-5">
            <h4 class="mb-4">Change Password</h4>

            <form action="{{ route('profile.password.update') }}" method="POST">
              @csrf
              @method('PATCH')
              <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                  class="form-control
                                                                                                                                                                                                                                                                                                                      @error('current_password') is-invalid @enderror">
                @error('current_password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <div class="mb-3">
                <label for="password" class="form-labe">New Passowrd</label>
                <input type="password" id="password" name="password"
                  class="form-control 
                                                                                                                                                                                                              @error('password') is-invalid @enderror">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
              </div>
              <button type="submit" class="btn btn-sm btn-warning"> Change Password</button>
            </form>






            <div class="mb-3 mt-2">
              <strong>Member Since:</strong>

              <p class="mb-0">
                {{ $user->created_at->format('F d, Y') }}
              </p>

            </div>

            <a href="{{ route('home') }}" class="btn btn-secondary">
              Home
            </a>

          </div>

        </div>

      </div>

    </div>
  </div>


@endsection