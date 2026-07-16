@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
      </div>

      <div class="mb-3">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
      </div>

      <div class="mb-3">
        <label for="">Role</label>

        <select name="role" class="form-select">

          <option value="author" {{ old('role', $user->role) == 'author' ? 'selected' : '' }}>
            Author
          </option>

          <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
            Admin
          </option>

        </select>


        <button class="btn btn-sm btn-success mt-2">Update</button>
        <a href="{{ route('admin.users.index', $user) }}" class="btn btn-sm btn-secondary mt-2">Back</a>
    </form>


  </div>
@endsection