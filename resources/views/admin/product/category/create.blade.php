@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add category</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.product.category.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputName" class="col-form-label">Name</label>
        <input id="inputName" type="text" name="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="parent_id">
            <option value="">Parent category</option>
            @foreach(Helper::productCategoryList() as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
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
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Add category</button>
      </div>
    </form>
  </div>
</div>
@endsection