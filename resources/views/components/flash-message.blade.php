@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">

    ✅ {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert">
    </button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    ❌ {{ session('error') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('warning'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    ⚠️ {{ session('warning') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('info'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">

    ℹ️ {{ session('info') }}

    <button type="button" class="btn-close" data-bs-dismiss="alert">
    </button>

  </div>
@endif