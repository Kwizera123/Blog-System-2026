@extends('layouts.frontend')

@section('content')
  <div class="container">
    <h2>Edit Comment</h2>
    <form action="{{ route('comments.update', $comment) }}" method="POST">
      @csrf
      @method('PUT')
      <textarea name="comment" id="" rows=" 3" class="form-control">
                                                                                                                                                                      {{ old('comment', $comment->comment) }}
                                                                                                                                                                              </textarea>
      <br>
      <button class="btn btn-success">Update Comment</button>
    </form>
  </div>


@endsection