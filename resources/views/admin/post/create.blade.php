@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add Post</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
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
        {{-- multiple korte hobe --}}
        <div class="form-group col-md-4">
          <select class="form-control chosen-select" name="category[]" multiple>
            <option value="" disabled>Post category</option>
            @foreach(Helper::postCategoryList() as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control chosen-select" name="tags[]" multiple>
            <option value="" disabled>Post tags</option>
            @foreach(Helper::postTagList() as $tag)
              <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-md-4">

        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" name="image" id="inputImage" multiple>
          <label class="custom-file-label" for="inputImage">File Input</label>
        </div>

        </div>
      </div>




      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
  </div>
</div>
@endsection