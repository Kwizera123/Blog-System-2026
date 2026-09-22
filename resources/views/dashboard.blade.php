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

        <div class="row g-4 mb-4 dashboard-stats">

            <!-- Tutorials Started -->
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-stat-card">
                    <div class="stat-icon">📚</div>

                    <div class="stat-content">
                        <div class="stat-label">Tutorials Started</div>
                        <div class="stat-number">{{ $tutorialsStarted }}</div>
                    </div>
                </div>
            </div>

            <!-- Tutorials In Progress -->
            <!-- In Progress -->
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-stat-card">
                    <div class="stat-icon">⏳</div>

                    <div class="stat-content">
                        <div class="stat-label">In Progress</div>
                        <div class="stat-number">{{ $tutorialsInProgress }}</div>
                    </div>
                </div>
            </div>

            <!-- Overall Progress -->
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-stat-card">
                    <div class="stat-icon">📊</div>

                    <div class="stat-content">
                        <div class="stat-label">Overall Progress</div>
                        <div class="stat-number">{{ $progressPercentage }}%</div>
                    </div>
                </div>
            </div>


            <!-- Tutorials Completed -->
            <!-- Tutorials Completed -->
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-stat-card">
                    <div class="stat-icon">✅</div>

                    <div class="stat-content">
                        <div class="stat-label">Tutorials Completed</div>
                        <div class="stat-number">{{ $tutorialsCompleted }}</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card dashboard-progress-card mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h5 class="mb-1">📊 Learning Progress</h5>
                        <p class="text-muted mb-0">
                            Keep going — you're making great progress!
                        </p>
                    </div>

                    <strong class="progress-percentage">
                        {{ $progressPercentage }}%
                    </strong>
                </div>

                <div class="progress dashboard-progress" role="progressbar" aria-valuenow="{{ $progressPercentage }}"
                    aria-valuemin="0" aria-valuemax="100">

                    <div class="progress-bar" style="width: {{ $progressPercentage }}%;">
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-2">
                    <small class="text-muted">
                        {{ $tutorialsCompleted }} completed
                    </small>

                    <small class="text-muted">
                        {{ $tutorialsInProgress }} remaining
                    </small>
                </div>

            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-sm btn-secondary mt-4">
            Home
        </a>



    </div>


@endsection