@extends('layouts.app')
@section('content')
  <div class="container mt-4">
    <h2>Create New Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>

        <select name="category_id" class="form-select">
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
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
      </div>



      <div class="mb-3">

        <label for="contentEditor" class="form-label">
          Content
        </label>

        <div class="mb-2">

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

            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wrapSelection('<p>', '</p>')">
              P
            </button>


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
              &lt;/&gt; Code Block
            </button>

          </div>

        </div>



        <textarea name="content" rows="15" class="form-control" id="contentEditor"
          placeholder="Write your tutorial content here...">{{ old('content') }}</textarea>
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Featured Image</label>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="mb-3">
        <label for="" class="control-label"><span class="text text-danger">YouTube</span> Video URL</label>
        <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}"
          placeholder="https://www.youtube.com/watch?=...">
        <small class="text-muted">
          Optional. Paste a YouTube video link.
        </small>
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Status</label>
        <select name="status" id="" class="form-control">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
      </div>

      <button class="btn btn-primary">Publish Post</button>
      <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
    </form>


    {{--
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

      function testHeading() {

        alert('1 - function started');

        const editor = document.getElementById('contentEditor');

        alert('2 - editor found: ' + (editor !== null));

        alert('3 - selected text: "' +
          editor.value.substring(
            editor.selectionStart,
            editor.selectionEnd
          ) +
          '"');
      }



    </script> --}}

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


      //

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