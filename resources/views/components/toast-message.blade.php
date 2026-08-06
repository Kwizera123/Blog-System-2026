@php
  $notifications = [
    'success',
    'error',
    'warning',
    'info'
  ];

  $type = null;
  $message = null;

  foreach ($notifications as $notification) {

    if (session()->has($notification)) {

      $type = $notification;
      $message = session($notification);

      break;
    }
  }
@endphp

@if ($message)


  <div class="toast-container position-fixed top-0 end-0 p-3">

    <div id="successToast" class="toast show border-0
     @if($type === 'success')
      text-bg-success
    @elseif($type === 'error')
      text-bg-danger
    @elseif ($type === 'warning')
      text-bg-warning
    @else
      text-bg-info
    @endif
      " role="alert" data-bs-delay="5000">

      <div class="d-flex">

        <div class="toast-body">

          @if($type === 'success')
            ✅
          @elseif ($type === 'error')
            ❌
          @elseif($type === 'warning')
            ⚠️
          @else
            ℹ️
          @endif

          {{ $message }}

        </div>

        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
        </button>

      </div>

    </div>

  </div>

  <script>

    document.addEventListener('DOMContentLoaded', function () {

      const toastElement = document.getElementById('successToast');

      if (toastElement) {

        const toast = new bootstrap.Toast(toastElement);

        toast.show();

      }

    });

  </script>
@endif