@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit Product</h5>
  <div class="card-body">
    @if($post)
    <form method="post" action="{{ route('admin.post.update',$post->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" value="{{$post->title}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control rich-editor" id="inputBody" name="body" rows="3">{{$post->body}}</textarea>
      </div>


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
    @else
    <h2>Invalid post</h2>
    @endif
  </div>
</div>
@endsection