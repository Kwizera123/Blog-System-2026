@extends('layouts.app')
@section('content')
  <div class="containe">
    <h1>User Details</h1>
    <div class="card">
      <div class="card-body">
        <h4>{{ $user->name }}</h4>
        <p><strong>Email:</strong>{{ $user->email }}</p>
        <p><strong>Role:</strong>{{ ucfirst($user->role) }}</p>
        {{-- <p><strong>Joined:</strong> {{ $user->created_at->diffForHumans() }}</p> --}}
        <p><strong>Total Posts:</strong>{{ $user->posts()->count() }}</p>
        <p><strong>Total Comments:</strong>{{ $user->comments()->count() }}</p>
      </div>
    </div>
    <a href="{{ route('admin.users.index', $user) }}" class="btn btn-secondary mt-2">Back</a>
  </div>
@endsection