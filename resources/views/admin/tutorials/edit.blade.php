@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h1 class="mb-4"><i class="bi bi-pencil"></i>📚 Edit Tutorial</h1>

    <form action="{{ route('admin.tutorials.update', $tutorial) }}" method="POST" enctype="multipart/form-data">

      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="title" class="form-label">TutorialTitle</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $tutorial->title) }}"
          required>
      </div>

      <div class="mb-3"> <label for="category_id" class="form-label"> Category </label>
        <select name="category_id" id="category_id" class="form-control" required>
          <option value="">Select Category</option>

          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id', $tutorial->category_id) == $category->id ? 'selected' : '' }}> {{ $category->name }} </option> @endforeach
        </select>
      </div>

      <!--Tags-->
      {{-- <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" id="tags" class="form-control mb-2 @error('tags') is-invalid @enderror" multiple>

          @foreach ($tags as $tag)
          <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $tutorial->tags->pluck('id')->toArray())) ?
            'selected' : '' }}>
            {{ $tag->name }}
          </option>
          @endforeach
        </select>
        @error('tags')
        <div class="invalid-feedback mb-1">
          {{ $message }}
        </div>
        @enderror
        <small class="text-emerald-500 mt-4"><strong> Hold Ctrl (Windows) or Command (Mac) to select multiple
            tags.</strong>
        </small>
      </div> --}}

      {{-- Tags --}}

      <div class="mb-3">

        <label for="tags" class="form-label">
          Tags
        </label>

        <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>


          @foreach ($tags as $tag)

            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $tutorial->tags->pluck('id')->toArray())) ? 'selected' : '' }}>

              {{ $tag->name }}

            </option>

          @endforeach


        </select>

        @error('tags')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

        <small class="text-muted">
          Hold Ctrl (Windows) or Command (Mac) to select multiple tags.
        </small>

      </div>

      <!--End of Tags-->

      <div class="mb-3">

        <label for="contentEditor" class="form-label">
          Content
        </label>

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

        <div class="mb-2">

          <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<strong>', '</strong>')">
            <strong>B</strong>
          </button>

          <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<em>', '</em>')">
            <em>I</em>
          </button>

        </div>

        <textarea name="content" rows="15" class="form-control" id="contentEditor"
          placeholder="Write your tutorial content here...">


                      {{ old('content', $tutorial->content) }}
                      </textarea>
      </div>

      <div class="mb-3">
        <label class="form-label"> Current Image </label>
        @if ($tutorial->image)
          <div class="mb-2">
            <img src="{{ asset('storage/' . $tutorial->image) }}" alt="{{ $tutorial->title }}" style="max-width: 250px;"
              class="img-thumbnail">
          </div>
        @else
          <p class="text-muted">No image uploaded.</p>
        @endif
      </div>

      <div class="mb-3">
        <label for="image" class="form-label"> Replace Image </label>
        <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <small class="text-muted">
          Leave empty to keep the current image.
        </small>
      </div>

      <div class="mb-3">
        <label for="video_url" class="form-label"> Video URL </label>
        <input type="url" name="video_url" id="video_url" class="form-control"
          value="{{ old('video_url', $tutorial->video_url) }}">
      </div>

      <div class="mb-3">
        <label for="status" class="form-label"> Status </label>
        <select name="status" id="status" class="form-control" required>
          <option value="draft" {{ old('status', $tutorial->status) === 'draft' ? 'selected' : '' }}>
            Draft
          </option>

          <option value="published" {{ old('status', $tutorial->status) === 'published' ? 'selected' : '' }}>
            Published
          </option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="bi bi-pencil-square"></i> Update Tutorial
      </button>
      <a href="{{ route('admin.tutorials.index') }}" class="btn btn-secondary"> Cancel </a>

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
  </div>
@endsection