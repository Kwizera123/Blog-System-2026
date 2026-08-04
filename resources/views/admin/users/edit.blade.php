@extends('layouts.app')

@section('content')

  <div class="container mt-4">


    <h1 class="mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">

      @csrf
      @method('PUT')


      {{-- Name --}}
      <div class="mb-3">

        <label for="name" class="form-label">
          Name
        </label>

        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">

      </div>


      {{-- Email --}}
      <div class="mb-3">

        <label for="email" class="form-label">
          Email
        </label>

        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">

      </div>


      {{-- Role --}}
      <div class="mb-3">

        <label for="role" class="form-label">
          Role
        </label>

        <select name="role" id="role" class="form-select">

          <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
            Admin
          </option>

          <option value="author" {{ old('role', $user->role) === 'author' ? 'selected' : '' }}>
            Author
          </option>

          <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>
            Editor
          </option>

        </select>

      </div>


      {{-- Actions --}}
      <button type="submit" class="btn btn-success">
        Update User
      </button>

      <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        Back
      </a>

    </form>


  </div>

@endsection