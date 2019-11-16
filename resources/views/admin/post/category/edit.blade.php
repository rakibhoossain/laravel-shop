@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit category</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.post.category.update', $category->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputName" class="col-form-label">Name</label>
        <input id="inputName" type="text" name="name" class="form-control" value="{{$category->name}}">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3">{{$category->description}}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="parent_id">
            <option value="">Default select</option>
            @foreach(Helper::postCategoryList() as $cat)
              <option value="{{$cat->id}}" @if($category->parent_id == $cat->id) selected @endif >{{$cat->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">

        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" name="image" id="inputImage" multiple>
          <label class="custom-file-label" for="inputImage">File Input</label>
        </div>
        <img class="rounded float-left" src="{{asset('images/category/'.$category->image)}}" alt="{{$category->name}}" width="200" height="200"/>
        </div>
      </div>


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection