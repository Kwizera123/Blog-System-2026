@extends('layouts.app')
@section('content')
  <div class="container">

    <div class="mb-4">

      <h1>
        Welcome Back, {{ auth()->user()->name }}
      </h1>
      <p class="text-muted">Here is what is happening in your application today.</p>
    </div>

    <div class="card shadow bg-body-tertiary rounded mb-4">
      <div class="card-body">
        <h4 class="mb-3">
          ⚡ Quick Actions
        </h4>

        <div class="d-flex flex-wrap gap-2">
          <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
            📝 Create Post
          </a>
          <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-success">
            👥 Manage Users
          </a>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-warning">
            🗂️ Manage Categories
          </a>
          <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-info">
            🏷️ Manage Tags
          </a>
          <a href="{{ route('admin.comments.index') }}" class="btn btn-sm btn-danger">
            💬 Moderate Comments
          </a>

          <a href="{{ route('admin.tutorials.index') }}" class="btn btn-sm btn-success">
            <i class="bi bi-stars"></i> Tutorial Management
          </a>

          <a href="{{ route('admin.contact-messages.index') }}" class="btn message text-white">
            <i class="bi bi-chat-left-text"></i> Contact Message Management
          </a>

          <a href="{{ route('admin.about.index') }}" class="btn about text-white">
            <i class="bi bi-chat-left-text"></i> About Page Management
          </a>

        </div>

      </div>
    </div>

    <div class="row g-3 mt-4">

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card text-center shadow-sm text-bg-success h-100">
          <div class=" card-body">
            <h5>👥 <strong>Total User:</strong></h5>
            <h2>{{ $totalUsers }}</h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn- btn-outline-light"><strong>View</strong></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card text-center shadow-sm text-bg-primary h-100">
          <div class="card-body">
            <h5>📝 <strong>Total Posts:</strong>
            </h5>
            <h2>{{ $totalPosts }}</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn- btn-outline-light"><strong>View</strong></a>

          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card text-center text-bg-danger shadow-sm h-100">
          <div class="card-body">
            <h5>💬 <strong>Pending Comments</strong> </h5>
            <h2>{{ $pendingComments }}</h2>
            <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}"
              class="btn btn-sm btn- btn-outline-light"><strong>Review</strong></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card text-center text-bg-warning shadow-sm h-100">
          <div class="card-body">
            <h5>🗂️ <strong>Total Categorie:</strong></h5>
            <h2>{{ $totalCategories }}</h2>
            <a href="{{ route('admin.categories.index') }}"
              class="btn btn-sm btn- btn-outline-light"><strong>View</strong></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 mt-2">
        <div class="card text-center text-bg-info shadow-sm h-100">
          <div class="card-body">
            <h5>
              <strong>Total Tags:</strong>
            </h5>
            <h2>{{ $totalTags }}</h2>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn- btn-outline-light"><strong>View</strong></a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 mt-2">
        <div class="card text-center text-bg-danger shadow-sm h-100">
          <div class="card-body">
            <h5>💬 <strong>Manage Comments</strong></h5>
            <h2>{{ $totalComments }}</h2>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-sm btn- btn-outline-light">
              <strong>View</strong>
            </a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 mt-2">
        <div class="card text-center bg-success-subtle shadow-sm h-100">
          <div class="card-body">
            <h5>🗂️ <strong>Total Post Published:</strong></h5>
            <h2 class="badge text-bg-success">{{ $publishPosts }}</h2>

          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 mt-2">
        <div class="card text-center bg-danger-subtle shadow-sm h-100">
          <div class="card-body">
            <h5>🗂️ <strong>Total Draft Posts:</strong></h5>
            <h2 class="badge text-bg-danger"><strong>{{ $draftPosts }}</strong></h2>
            {{-- <a href="#" class="btn btn-sm btn- text-white"><strong></strong></a> --}}
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">

        <div class="card shadow-sm h-100">

          <div class="card-body">

            <h6 class="text-muted">
              Unread Messages
            </h6>
            @if ($unreadMessages >= 1)
              <h2><span class="translate-center badge rounded-pill bg-danger mb-1">
                  {{ $unreadMessages }}
                </span>
              </h2>
            @else

              <h2><span class="translate-center badge rounded-pill bg-secondary mb-1">
                  {{ $unreadMessages }}
                </span>
              </h2>
            @endif

            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-primary">
              📩 View Messages
            </a>

          </div>

        </div>

      </div>

      <div class="col-12 col-sm-6 col-lg-3">

        <div class="card text-center shadow-sm text-bg-secondary h-55">

          <div class="card-body">

            <h5>
              👁️ <strong>Total Content Views:</strong>
            </h5>

            <h2>
              {{ $totalContentViews }}
            </h2>

            <small>
              Posts + Tutorials
            </small>

          </div>

        </div>

      </div>

    </div>




    <hr class="my-5">
    <h3>
      <span class="badge text-bg-primary mb-2">Recent Posts</span>
    </h3>
    <table class="table table-striped shadow bg-body-tertiary rounded">
      <thead>
        <tr>
          <th>Title</th>
          <th>Status</th>
          <th>Author</th>
          <th>Created</th>
          <th>More...</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($recentPosts as $post)
          <tr>
            <td>{{ $post->title }}</td>
            <td>
              @if($post->status === 'published')
                <span class="badge text-bg-success">
                  Published
                </span>
              @elseif($post->status === 'draft')
                <span class="badge text-bg-warning">
                  Draft
                </span>
              @else
                <span class="badge text-bg-secondary">
                  {{ ucfirst($post->status) }}
                </span>
              @endif
            </td>
            <td>{{ $post->user->name }}
            </td>
            <td>{{ $post->created_at->diffForHumans() }}</td>
            <td>
              <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-4">
              No Posts found.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <hr class="my-5">

    <div class="card shadow p-3 bg-body-tertiary rounded mb-4">

      <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
          🔥 Most Viewed Posts
        </h5>

        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">
          View All
        </a>

      </div>

      <div class="card-body">

        @forelse ($mostViewedPosts as $post)

          <div class="d-flex justify-content-between align-items-center border-bottom py-2">

            <div>

              <h6 class="mb-1">
                {{ $post->title }}
              </h6>

              <small class="text-muted">
                By {{ $post->user->name }}
              </small>

            </div>

            <span class="badge text-bg-info">

              <i class="bi bi-eye"></i>

              {{ $post->views }}

              {{ Str::plural('view', $post->views) }}

            </span>

          </div>

        @empty

          <p class="text-muted mb-0">
            No posts available yet.
          </p>

        @endforelse

      </div>

    </div>

    <hr class="my-5">

    <div class="card shadow bg-body-tertiary rounded mb-4">

      <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
          ⭐ Most Viewed Tutorials
        </h5>

        <a href="{{ route('admin.tutorials.index') }}" class="btn btn-sm btn-primary">
          View All
        </a>

      </div>

      <div class="card-body">

        @forelse ($mostViewedTutorials as $tutorial)

          <div class="d-flex justify-content-between align-items-center border-bottom py-2">

            <div>

              <h6 class="mb-1">
                {{ $tutorial->title }}
              </h6>

              <small class="text-muted">
                Tutorial
              </small>

            </div>

            <span class="badge text-bg-info">

              <i class="bi bi-eye"></i>

              {{ $tutorial->views }}

              {{ Str::plural('view', $tutorial->views) }}

            </span>

          </div>

        @empty

          <p class="text-muted mb-0">
            No tutorials available yet.
          </p>

        @endforelse

      </div>

    </div>

    <hr class="my-5">

    <div class="card shadow-sm mb-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            🔥 Most Viewed Content
        </h5>

    </div>

    <div class="card-body p-0">

        @if ($mostViewedContent->count() > 0)

            <div class="table-responsive">

                <table class="table table-striped table-hover mb-0">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Content</th>
                            <th>Type</th>
                            <th>Views</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($mostViewedContent as $content)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <a href="{{ $content['url'] }}">
                                        {{ $content['title'] }}
                                    </a>
                                </td>

                                <td>

                                    @if ($content['type'] === 'Post')

                                        <span class="badge text-bg-primary">
                                            📝 Post
                                        </span>

                                    @else

                                        <span class="badge text-bg-success">
                                            📚 Tutorial
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="badge text-bg-info">

                                        <i class="bi bi-eye"></i>

                                        {{ $content['views'] }}

                                        {{ Str::plural('view', $content['views']) }}

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <p class="text-muted p-3 mb-0">
                No content views available yet.
            </p>

        @endif

    </div>

</div>

    <hr class="my-5">
    <h3><span class="badge text-bg-success mb-4">Latest Users</span></h3>
    <table class="table table-bordered shadow bg-body-tertiary rounded">
      <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>Role</td>
          <td>Joined</td>
        </tr>
      </thead>
      <tbody>
        @forelse ($latestUsers as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if($user->role === 'admin')
                <span class="badge text-bg-success">Admin</span>
              @elseif($user->role === 'editor')
                <span class="badge text-bg-primary">Editor</span>
              @elseif($user->role === 'author')
                <span class="badge text-bg-primary">Author</span>
              @else
                <span class="badge text-bg-danger">User</span>
              @endif
            </td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4">No Users found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <hr class="my-5">

    <h3><span class="badge text-bg-danger mb-2">Recent comments</span></h3>
    <table class="table table-hover shadow bg-body-tertiary rounded">
      <thead>
        <tr>
          <th>User</th>
          <th>Post</th>
          <th>Comment</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($recentComments as $comment)
          <tr>
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->post->title }}</td>
            <td>{{ Str::limit($comment->comment, 50) }}</td>
            <td>{{ $comment->created_at->diffForHumans() }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4">
              No Comments Found
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <hr class="my-5">

    <div class="card shadow bg-body-tertiary rounded mb-4">

      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          📩 Recent Contact Messages
        </h5>

        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-primary">
          View All
        </a>
      </div>

      <div class="card-body">

        @forelse ($recentContactMessages as $message)

          <div class="border-bottom pb-3 mb-3">

            <div class="d-flex justify-content-between align-items-start">

              <div>

                <h6 class="mb-1">
                  {{ $message->subject }}
                </h6>

                <small class="text-muted">
                  From: {{ $message->name }}
                  ({{ $message->email }})
                </small>

              </div>

              @if (!$message->is_read)

                <span class="badge bg-danger">
                  Unread
                </span>

              @else

                <span class="badge bg-secondary">
                  Read
                </span>

              @endif

            </div>

            <p class="mt-2 mb-2">
              {{ Str::limit($message->message, 120) }}
            </p>

            <div class="d-flex justify-content-between align-items-center">

              <small class="text-muted">
                {{ $message->created_at->format('M d, Y g:i A') }}
              </small>

              <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary">
                View Message
              </a>

            </div>

          </div>

        @empty

          <p class="text-muted mb-0">
            No contact messages yet.
          </p>

        @endforelse

      </div>

    </div>
  </div>
@endsection