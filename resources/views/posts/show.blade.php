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
       <p class="card-text" style="display:inline;">{{$post['title']}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">posted By:-</h5>
      <p class="card-text" style="display:inline;">{{$post['discription']}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">Created At:-</h5>
      {{-- @dd($post['created_at']->toDayDateTimeString()) --}}
    <p class="card-text" style="display:inline;">{{$post['created_at']->toDayDateTimeString()}}</p>
      </div>

  </div>
</div>
  @endsection
