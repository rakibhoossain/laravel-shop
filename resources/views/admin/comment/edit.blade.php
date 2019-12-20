@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit comment</h5>
  <div class="card-body">
    @if($comment)

    <form method="post" action="{{ route('admin.comments.update',$comment->id) }}">
      {{csrf_field()}}


    @if($comment->name)
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputName" class="col-form-label">Name</label>
          <input id="inputName" type="text" name="name" value="{{$comment->name}}" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="text" name="email" value="{{$comment->email}}" class="form-control">
        </div>
         <div class="form-group col-md-4">
          <label for="inputWebsite" class="col-form-label">Website</label>
          <input id="inputWebsite" type="text" name="website" value="{{$comment->website}}" class="form-control">
        </div>
      </div>
    @else
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputName" class="col-form-label">Name</label>
          <input id="inputName" type="text" class="form-control" disabled value="{{$comment->user->name}}">
        </div>
      </div>
    @endif

      <div class="form-group">
        <label for="inputDescription">Body</label>
        <textarea class="form-control" id="inputDescription" name="body" rows="3">{{$comment->body}}</textarea>
      </div>



        <div class="form-group">
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="1" @if($comment->status == '1') checked @endif name="status">Aproved
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="0" @if($comment->status == '0') checked @endif name="status">Pending
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" value="spam" @if($comment->status == 'spam') checked @endif name="status">Spam
            </label>
          </div>
        </div>


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>









    @else
      <h2>Comment Empty!</h2>
    @endif
  </div>
</div>
@endsection