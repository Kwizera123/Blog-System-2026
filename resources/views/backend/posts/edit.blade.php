@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2>Edit Post</h2>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Category</label>

        <select name="category_id" class="form-select">

          @foreach ($categories as $category)

            <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>
              {{ $category->name }}
            </option>

          @endforeach
        </select>



        <div class="mb-3">
          <label for="" class="form-label">
            Tags
          </label>

          <div class="row">
            @foreach ($tags as $tag)

                    <div class="col-md-3">

                      <div class="form-check">


                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                          id="tag{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ?
              'checked' : ''}}>



                        <label class="form-check-label">
                          {{ $tag->name }}
                        </label>

                      </div>
                    </div>

            @endforeach
          </div>
        </div>
      </div>

      {{-- <div class="mb-3">
        <label class="form-label">Category</label>

        <select name="category_id" class="form-select">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">
            {{ $category->name }}
          </option>
          @endforeach
        </select>
      </div> --}}

      {{-- <div class="mb-3">
        <label class="form-label">
          Tags
        </label>

        <div class="row">
          @forelse ($tags as $tag)

          <div class="col-md-3">

            <div class="form-check">

              <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}"
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

              <label class="form-check-label" for="tag{{ $tag->id }}">
                {{ $tag->name }}
              </label>

            </div>

          </div>

          @empty

          <p class="text-muted">
            No tags available.
          </p>

          @endforelse
        </div>
      </div> --}}



      <div class=" mb-3">
        <label for="contentEditor" class="form-label">Content</label>


        <div class="mb-2">

          <select id="codeLanguage" class="form-select form-select-sm w-auto d-inline-block">
            <option value="html">HTML</option>
            <option value="css">CSS</option>
            <option value="javascript">JavaScript</option>
            <option value="php">PHP</option>
            <option value="blade">Blade</option>
            <option value="laravel">Laravel</option>
          </select>

          <button type="button" class="btn btn-dark btn-sm" onclick="insertCodeBlock()">
            &lt;/&gt; Code Block
          </button>

        </div>


        <textarea name="content" rows="15" class="form-control" id="contentEditor"
          placeholder="Write your tutorial content here...">{{ old('content', $post->content) }}

                                   </textarea>

      </div>

      <div class="mb-3">
        <label for="" class="form-label">Featured Image</label>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="mb-3">
        <label for="" class="control-label"><span class="text text-danger">YouTube</span> Video URL</label>

        <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $post->video_url) }}"
          placeholder="https://www.youtube.com/watch?v=...">

        <small class="text-muted">
          Optional. Paste a YouTube video link.
        </small>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>

        <select name="status" id="status" class="form-control">
          <option value="draft" @selected($post->status === 'draft')>
            Draft
          </option>

          <option value="published" @selected($post->status === 'published')>
            Published
          </option>
        </select>
      </div>

      <button class="btn btn-success btn-sm">Update Post</button>
      <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a>

    </form>

    <script>
      function insertCodeBlock() {

        const editor = document.getElementById('contentEditor');

        const language = document.getElementById('codeLanguage').value;

        const start = editor.selectionStart;
        const end = editor.selectionEnd;

        const selectedText = editor.value.substring(start, end);

        const codeBlock = `[code:${language}]
    ${selectedText}
    [/code]`;

        editor.value =
          editor.value.substring(0, start) +
          codeBlock +
          editor.value.substring(end);

        editor.focus();

        const newCursorPosition =
          start + codeBlock.length;

        editor.setSelectionRange(
          newCursorPosition,
          newCursorPosition
        );
      }
    </script>


    @if ($post->status == 'draft')
      <form action="{{ route('admin.posts.publish', $post) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button class="btn btn-success btn-sm mt-1">Publish</button>
      </form>
    @else
      <form action="{{ route('admin.posts.unpublish', $post) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button class="btn btn-secondary btn-sm">Unpublish</button>
      </form>
    @endif
  </div>
@endsection