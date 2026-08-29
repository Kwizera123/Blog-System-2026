@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <div class="row d-flex flex-row-reverse">
      <h1>
        Contact Messages
      </h1>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-dark mb-2 dashboard"><i class="bi bi-speedometer"></i>
        Dashboard</a>
    </div>

    @forelse ($messages as $message)

      <div class=" card mb-3">

        <div class="card-body">

          <h5>
            {{ $message->subject }}
          </h5>

          @if (!$message->is_read)
            <span class="badge bg-primary">
              🔵 Unread
            </span>

          @else
            <span class="badge bg-secondary">
              ⚪ Read
            </span>

          @endif

          <p class="mb-1">
            <strong>Name:</strong>
            {{ $message->name }}
          </p>

          <p class="mb-1">
            <strong>Email:</strong>
            {{ $message->email }}
          </p>

          <p class="mb-1">
            <strong>Received:
            </strong>
            {{ $message->created_at->format('M d, Y g:i A') }}
          </p>

          <p class="mb-0">
            <strong>Message:</strong>
            {{ Str::limit($message->message, 150) }}
          </p>
          <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-primary btn-sm mt-3">
            <i class="bi bi-eye-fill"></i> View Message
          </a>

        </div>


      </div>

    @empty

      <p>No contact messages found.</p>

    @endforelse


    @if ($messages->hasPages())
      <div class="mt-4">
        {{ $messages->links() }}
      </div>
    @endif
  </div>

@endsection