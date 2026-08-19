@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h1><strong>📚 Create Tutorial</strong></h1>

    <p class="text-muted mt-3 mb-3">
      Create a new tutorial for your website.
    </p>
    <form action="{{ route('admin.tutorials.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Title--}}
      <div class="mb-3">
        <label for="title" class="form-label">Tutorial Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title') }}" placeholder="Enter tutorial title">

        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

      </div>

      {{-- Category --}}
      <div class="mb-3">

        <label for="category_id" class="form-label">
          Category
        </label>

        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
          <option value="">Select Category</option>

          @foreach ($categories as $category)

            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>

          @endforeach
        </select>

        @error('category_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Tag --}}
      <div class="mb-3">

        <label for="tags" class="form-label">Tags</label>

        <select name="tags[]" id="tags" class=" mb-3 form-control @error('tags') is-invalid @enderror" multiple>

          @foreach ($tags as $tag)

            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
              {{ $tag->name }}
            </option>

          @endforeach

        </select>

        @error('tags')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
        <span class="text-emerald-500 mt-4"><small>Hold Ctrl(Windows) or Command(Mac)to select multiple
            tags.</small></span>
      </div>

      {{-- Content --}}
      <div class="mb-3">
        <label for="contentEditor" class="form-label">
          Tutorial Content
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

        </div>

        <div class="border rounded p-2 mb-2 bg-light">

          <div class="d-flex flex-wrap gap-2 align-items-center">

            {{-- Text Formatting --}}
            <span class="text-muted small fw-bold">
              Text:
            </span>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<strong>', '</strong>')">
              <strong>B</strong>
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<em>', '</em>')">
              <em>I</em>
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<u>', '</u>')">
              <u>U</u>
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<p>', '</p>')">
              P
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<blockquote>', '</blockquote>')">
              ❝ Quote
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<hr>', '')">
              <strong>HR</strong>
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<div style=\'text-align: left;\'>', '</div>')">
              Left
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<div style=\'text-align: center;\'>', '</div>')">
              Center
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<div style=\'text-align: right;\'>', '</div>')">
              Right
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm"
              onclick="wrapSelection('<div style=\'text-align: justify;\'>', '</div>')">
              Justify
            </button>

            <select class="form-control form-select-sm d-inline-block" style="width: auto;"
              onchange="wrapSelection(this.value, '</span>'); this.selectedIndex = 0;">
              <option value="">Font Size</option>
              <option value="<span style='font-size: 12px;'>">Small</option>
              <option value="<span style='font-size: 16px;'>">Normal</option>
              <option value="<span style='font-size: 20px;'>">Large</option>
              <option value="<span style='font-size: 24px;'>">Extra Large</option>
              <option value="<span style='font-size: 30px;'>">Huge Large</option>
            </select>

            <input type="color" class="form-control form-control-color" title="Text Color"
              onchange="wrapSelection('<span style=\'color:' + this.value + ';\'>', '</span>')">

            <input type="color" class="form-control form-control-color" title="Highlight Color"
              onchange="wrapSelection('<span style=\'background-color:' + this.value + ';\'>', '</span>')">

            <span class="border-start mx-1" style="height: 25px;"></span>


            {{-- Headings --}}
            <span class="text-muted small fw-bold">
              Headings:
            </span>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<h1>', '</h1>')">
              H1
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<h2>', '</h2>')">
              H2
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<h3>', '</h3>')">
              H3
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<h4>', '</h4>')">
              H4
            </button>


            <span class="border-start mx-1" style="height: 25px;"></span>


            {{-- Lists --}}
            <span class="text-muted small fw-bold">
              Lists:
            </span>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="createList('ul')">
              • List
            </button>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="createList('ol')">
              1. List
            </button>


            <span class="border-start mx-1" style="height: 25px;"></span>


            {{-- Links --}}
            <span class="text-muted small fw-bold">
              Links:
            </span>

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="insertLink()">
              🔗 Link
            </button>

            <button type="button" class="btn btn-dark btn-sm" onclick="insertCodeBlock()">
              &lt;/&gt; Code
            </button>



          </div>

        </div>



        <textarea name="content" rows="15" class="form-control" id="contentEditor"
          placeholder="Write your tutorial content here...">{{ old('content') }}</textarea>


        @error('content')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Image --}}
      <div class="mb-3">

        <label for="image" class="form-label">
          Tutorial Image
        </label>

        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Video URL --}}
      <div class="mb-3">

        <label for="video_url" class="form-label">
          Video URL
        </label>

        <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror"
          value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">

        @error('video_url')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Status --}}
      <div class="mb-3">

        <label for="status" class="form-label">
          Status
        </label>

        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">

          <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
            Draft
          </option>

          <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
            Published
          </option>

        </select>


        @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

      </div>

      <button type="submit" class="btn btn-primary">
        Create Tutorial
      </button>

      <a href="{{ route('admin.tutorials.index') }}" class="btn btn-secondary">
        Cancel
      </a>



    </form>

    <script>

      // Improve insertCodeBlock()
      function insertCodeBlock() {

        const editor = document.getElementById('contentEditor');

        const language =
          document.getElementById('codeLanguage').value;

        const start = editor.selectionStart;
        const end = editor.selectionEnd;

        const selectedText =
          editor.value.substring(start, end);

        let codeBlock;

        let cursorPosition;


        // If text is selected
        if (selectedText.trim() !== '') {

          codeBlock =
            `[code:${language}]
                                                            ${selectedText}
                                                            [/code]`;

          cursorPosition =
            start + codeBlock.length;

        }

        // If nothing is selected
        else {

          codeBlock =
            `[code:${language}]

                                                            [/code]`;

          cursorPosition =
            start + `[code:${language}]
                                                            `.length;
        }


        editor.value =
          editor.value.substring(0, start) +
          codeBlock +
          editor.value.substring(end);


        editor.focus();


        // Put cursor in the appropriate position
        editor.setSelectionRange(
          cursorPosition,
          cursorPosition
        );
      }


      function wrapSelection(before, after) {

        const editor = document.getElementById('contentEditor');

        const start = editor.selectionStart;

        const end = editor.selectionEnd;

        const selectedText =
          editor.value.substring(start, end);

        const replacement =
          before + selectedText + after;

        editor.value =
          editor.value.substring(0, start) +
          replacement +
          editor.value.substring(end);

        editor.focus();

        editor.setSelectionRange(
          start + before.length,
          start + before.length + selectedText.length
        );
      }

      // List
      function createList(type) {

        const editor = document.getElementById('contentEditor');

        const start = editor.selectionStart;
        const end = editor.selectionEnd;

        const selectedText = editor.value.substring(start, end);

        const lines = selectedText
          .split('\n')
          .filter(line => line.trim() !== '');

        const listItems = lines
          .map(line => `<li>${line.trim()}</li>`)
          .join('\n');

        const list = `<${type}>\n${listItems}\n</${type}>`;

        editor.value =
          editor.value.substring(0, start) +
          list +
          editor.value.substring(end);

        editor.focus();

        const newCursorPosition = start + list.length;

        editor.setSelectionRange(
          newCursorPosition,
          newCursorPosition
        );
      }

      // Link

      function insertLink() {

        const editor = document.getElementById('contentEditor');

        const start = editor.selectionStart;
        const end = editor.selectionEnd;

        const selectedText = editor.value.substring(start, end);

        if (!selectedText) {
          alert('Please select the text you want to turn into a link.');
          return;
        }

        const url = prompt('Enter the URL:');

        if (!url) {
          return;
        }

        const trimmedUrl = url.trim();

        if (
          !trimmedUrl.startsWith('https://') &&
          !trimmedUrl.startsWith('http://') &&
          !trimmedUrl.startsWith('mailto:')
        ) {
          alert('Please enter a valid URL starting with http://, https://, or mailto:');
          return;
        }

        const link =
          `<a href="${trimmedUrl}" target="_blank" rel="noopener noreferrer">${selectedText}</a>`;

        editor.value =
          editor.value.substring(0, start) +
          link +
          editor.value.substring(end);

        editor.focus();

        const newCursorPosition = start + link.length;

        editor.setSelectionRange(
          newCursorPosition,
          newCursorPosition
        );
      }

    </script>

  </div>
@endsection