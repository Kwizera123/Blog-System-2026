@extends('layouts.home')

@section('content')
  <div class="container">
    <h2>Edit Comment</h2>
    <form action="{{ route('comments.update', $comment) }}" method="POST">
      @csrf
      @method('PUT')
      <textarea name="comment" id="" rows=" 3" class="form-control mt-3">
                                                                                                                                                                                                                                                                                                    {{ old('comment', $comment->comment) }}
                                                                                                                                                                                                                                                                                                            </textarea>
      <br>
      <button class="btn btn-success">Update Comment</button>
      <a href="{{ route('post.show', $comment->post->slug) }}" class=" btn text-bg-secondary">Back to post</a>
    </form>
  </div>


@endsection