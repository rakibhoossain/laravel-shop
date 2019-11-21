@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add Product</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control rich-editor" id="inputDescription" name="description" rows="3"></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputPrice" class="col-form-label">Price</label>
          <input id="inputPrice" type="text" name="price" class="form-control" placeholder="Numbers">
        </div>
        <div class="form-group col-md-4">
          <label for="inputOfferPrice" class="col-form-label">Offer price</label>
          <input id="inputOfferPrice" type="text" name="offer_price" class="form-control" placeholder="Numbers">
        </div>
        <div class="form-group col-md-4">
          <label for="inputQuantity" class="col-form-label">Quantity</label>
          <input id="inputQuantity" type="number" name="quantity" class="form-control" placeholder="Numbers">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="category_id">
            <option value="">Select category</option>
            @foreach(Helper::productCategoryList() as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control" name="brand_id">
            <option value="">Select brand</option>
            @foreach(Helper::productBrandList() as $brand)
              <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control" name="status">
            <option>Default select</option>
          </select>
        </div>
      </div>



{{-- 
      <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" name="image[]" id="inputImage[]" multiple>
        <label class="custom-file-label" for="inputImage[]">File Input</label>
      </div>

      <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" name="image[]" id="inputImage[]" multiple>
        <label class="custom-file-label" for="inputImage[]">File Input</label>

      </div>
 --}}




        <div class="input-group control-group increment mb-3" id="imageuUpload">
          <input type="file" name="image[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" id="add_image_field" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        
        <div  class="clone_image d-none">
          <div class="control-group input-group mb-3" style="margin-top:10px">
            <input type="file" name="image[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove_image_field" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
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