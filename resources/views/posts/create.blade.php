@extends('layouts.app')

@section('title')Update post @endsection

@section('content')
      <form method="POST" action="{{route('posts.store')}}" class="mt-5">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
            <select name='post_creator' class="form-control">
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <br/>
            <input name="discription"  type="text" class="form-control" id="description"> 
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Created At</label>
            <input name="createdat" type="date" class="form-control" id="exampleFormControlInput1">
       </div>

          <div class="mb-3">
                <button type="submit" class="btn btn-success">Create Post</button>
          </div>
        </form>
@endsection
