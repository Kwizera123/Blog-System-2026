@extends('layouts.app')

@section('content')

  <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

      <h1>
        Contact Message
      </h1>

      <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
        ← Back to Messages
      </a>

    </div>


    <div class="card">

      <div class="card-body">

        <h3 class="mb-4">
          {{ $contactMessage->subject }}
        </h3>

        <p>
          <strong>Name:</strong>
          {{ $contactMessage->name }}
        </p>

        <p>
          <strong>Email:</strong>
          {{ $contactMessage->email }}
        </p>

        <hr>

        <h5 class="read-message">
          Message
        </h5>

        <p>
          {{ $contactMessage->message }}
        </p>

        <hr>

        <p class="text-muted mb-2">
          Received:
          {{ $contactMessage->created_at->format('F j, Y g:i A') }}
        </p>
        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this message?');">

          @csrf
          @method('DELETE')

          <button type="submit" class="btn btn-danger">
            🗑️ Delete Message
          </button>

        </form>

      </div>

    </div>

  </div>

@endsection