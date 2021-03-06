@extends('layouts.app')

@section('title')Create @endsection

@section('content')
        <form class="col-6 mx-auto my-5"  method="POST" enctype="multipart/form-data" action="{{route('posts.update',['post' => $post["id"] ])}}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label for="exampleInputTitle" class="form-label">Title</label>
              <input name="title" value="{{$post['title']}}" type="text" class="form-control" id="exampleInputTitle" >
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
              <input name="discription" value="{{$post['discription']}}" type="text" class="form-control" id="description"> 
               
            </div>
            <div class="my-3 fs-3">
              <input class="form-control form-control-lg" name="image" id="formFileLg" type="file">
            </div>

              <div class="mb-3">
                <label for="exampleInputDate" class="form-label">Created At</label>
                <input name="created_at" value="{{$post['created_at']}}" type="date" class="form-control"  id="exampleInputDate">
              </div>

            <button type="submit" class="btn btn-success">update Post</button>
          </form>
          @endsection
