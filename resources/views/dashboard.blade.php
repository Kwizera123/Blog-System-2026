@extends('layouts.user-profile')

@section('content')
    <div class="container mt-5">
        <h1>
            <span class="alert alert-success alert-link"> User Dashboard</span>
        </h1>

        <div class="card shadow-sm mt-2 mb-2">

            <div class="card-body">

                <h1 class="mb-2">
                    👋 Welcome back, {{ auth()->user()->name }}
                </h1>

                <p class="text-muted mb-0">
                    Continue your learning journey and keep building your
                    web development skills.
                </p>

            </div>


            {{-- Your existing dashboard content remains below --}}

        </div>

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-3">
                    ⚡ Quick Actions
                </h4>

                <div class="d-flex flex-wrap gap-2">

                    <a href="{{ route('tutorials.index') }}" class="btn btn-primary">

                        📚 Browse Tutorials

                    </a>

                    <a href="{{ route('blog.index') }}" class="btn btn-success">

                        📝 Browse Blog

                    </a>

                    <a href="{{ route('blogprofile.index') }}" class="btn btn-warning">

                        👤 My Profile

                    </a>

                </div>

            </div>

        </div>


        <a href="{{ route('home') }}" class="btn btn-sm btn-secondary mt-4">
            Home
        </a>



    </div>


@endsection