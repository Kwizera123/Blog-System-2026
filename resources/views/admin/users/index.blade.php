@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Users</h1>

    <div class="table-responsive mt-4">

      <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search by name or email..."
            value="{{ request('search') }}">

          <button class="btn btn-primary">Search</button>
        </div>
      </form>

      <table class="table table-striped align-middle">
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
              <td>
                @if($user->role === 'admin')
                  <span class=" badge bg-success">Admin</span>
                @else
                  <span class="badge bg-secondary">Author</span>
                @endif
              </td>

              <td class="d-flex justify-content-evenly">
                <a href=" {{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">View</a>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                  Edit
                </a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <buttn class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to deletethis user?')">
                    Delete
                  </buttn>
                </form>
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
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">Back</a>
    {{ $users->links() }}
  </div>
@endsection