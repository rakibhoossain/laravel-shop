@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit slider</h5>
  <div class="card-body">
    @if($slider)
    <form method="post" action="{{ route('admin.slider.update',$slider->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" value="{{$slider->title}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Body</label>
        <textarea class="form-control rich-editor" id="inputBody" name="body" rows="3">{{$slider->body}}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputbutton" class="col-form-label">Action text</label>
          <input id="inputbutton" type="text" name="button" class="form-control" value="{{$slider->button}}">
        </div>
        <div class="form-group col-md-6">
          <label for="inputurl" class="col-form-label">Action link</label>
          <input id="inputurl" type="text" name="url" class="form-control" value="{{$slider->url}}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="image" id="inputImage" multiple>
            <label class="custom-file-label" for="inputImage">File Input</label>
          </div>
          @if($slider->image)
            <img class="rounded float-left" src="{{asset('images/slider/'.$slider->image)}}" alt="{{$slider->title}}" width="200" height="200"/>
          @endif
        </div>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>

    @else
    <h2>Invalid slider</h2>
    @endif
  </div>
</div>
@endsection