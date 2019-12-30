@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add Slider</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Body</label>
        <textarea class="form-control rich-editor" id="inputBody" name="body" rows="3"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputbutton" class="col-form-label">Action text</label>
        <input id="inputbutton" type="text" name="button" class="form-control">
        </div>
        <div class="form-group col-md-6">
          <label for="inputurl" class="col-form-label">Action link</label>
        <input id="inputurl" type="text" name="url" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" name="image" id="inputImage">
          <label class="custom-file-label" for="inputImage">File Input</label>
        </div>
      </div>
      
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
  </div>
</div>
@endsection