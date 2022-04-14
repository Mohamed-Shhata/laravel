@extends('layouts.app')

@section('title') View @endsection

@section('content')
<div class="card bg-secondery mt-5" >
  <div class="card-header">Post Info</div>
  <div class="card-body">

    <h5 class="card-title" style="font-size:18px;display:inline;">Title:-</h5>
    <p class="card-text" style="display:inline;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <h5 class="card-title mt-4" style="font-size:18px">Description:-</h5>
    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum sunt sequi excepturi impedit reprehenderit ipsum accusamus perspiciatis eum ex velit incidunt, dignissimos temporibus eos in maiores labore qui reiciendis non?.</p>
  </div>
</div>
<div class="card bg-secondery mt-5" style="max-width: 18rem,text-align:center;">
  
  <div class="card-header">Post Creator Info</div>
  <div class="card-body">
      <div class="p-2">
       <h5 class="card-title" style="font-size:18px;display:inline;">Title:-</h5>
       <p class="card-text" style="display:inline;">{{$posts['title']}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">posted By:-</h5>
      <p class="card-text" style="display:inline;">{{$posts['discription']}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">Created At:-</h5>
      {{-- @dd($post['created_at']->toDayDateTimeString()) --}}
    <p class="card-text" style="display:inline;">{{$posts['created_at']->toDayDateTimeString()}}</p>
      </div>

  </div>
</div>
<h1 class="text-center bg-primary text-light rounded p-4">Comments</h1>
<div>
    <form method="POST" action="{{route('comments.create' , ['postId' => $posts['id']])}}">
        @csrf
        <label for="exampleFormControlInput1" class="form-label fs-2">Add a comment</label>
        <input class="form-control form-control-lg" type="text" placeholder="Add a comment" name="comment" id="coment" aria-label=".form-control-lg example">
        <button type="submit" class="btn btn-primary btn-lg mt-3">Add</button>
    </form>
</div>
{{-- comments --}}
<div class='mt-4 bg-light text-dark'>

    @foreach ($posts->comments as $comment)

    <div class='my-4 border p-4 rounded-lg'>
        <h2 class='text-lg fw-bold'>{{$comment->user->name}}</h2>
        <p class='text-lg my-2 fs-2'>{{$comment->body}}</p>
        <span class='text-sm'>Last Updated At: {{$comment->updated_at->toDayDateTimeString()}}</span>
        <div class="mt-4  flex">
            <form class="text-center d-inline" method='POST' action="{{route('comments.delete', ['postId' => $posts['id'], 'commentId' => $comment->id])}}">
                @csrf
                @method('DELETE')
                <button type="sumbit" class='btn btn-lg btn-danger'>Delete</button>
            </form>
            <a class='btn btn-lg btn-primary ml-4' href="{{route('comments.view', ['postId' => $posts['id'], 'commentId' => $comment->id])}}">
                Edit
            </a>
        </div>
    </div>
    @endforeach

</div>
<div class="my-3">
    <a href="{{route('posts.index')}}" class="btn btn-primary btn-lg">Back</a>
</div>
  @endsection
