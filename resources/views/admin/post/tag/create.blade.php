@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add tag</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.post.tag.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputName" class="col-form-label">Name</label>
        <input id="inputName" type="text" name="name" class="form-control">
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Add tag</button>
      </div>
    </form>
  </div>
</div>
@endsection