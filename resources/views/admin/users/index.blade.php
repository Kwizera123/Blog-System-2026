@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Users</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
              <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">View</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted">
              No Users found.
            </td>
          </tr>
        @endforelse

      </tbody>
    </table>
    {{ $users->links() }}
  </div>
@endsection