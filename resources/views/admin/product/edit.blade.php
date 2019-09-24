@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit Product</h5>
  <div class="card-body">
    @if($product)
    <form method="post" action="{{ route('admin.product.update',$product->id) }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" value="{{$product->title}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3">{{$product->description}}</textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputPrice" class="col-form-label">Price</label>
          <input id="inputPrice" type="number" name="price" class="form-control" placeholder="Numbers" value="{{$product->price}}">
        </div>
        <div class="form-group col-md-4">
          <label for="inputOfferPrice" class="col-form-label">Offer price</label>
          <input id="inputOfferPrice" type="number" name="offer_price" class="form-control" placeholder="Numbers" value="{{$product->offer_price}}">
        </div>
        <div class="form-group col-md-4">
          <label for="inputQuantity" class="col-form-label">Quantity</label>
          <input id="inputQuantity" type="number" name="quantity" class="form-control" placeholder="Numbers" value="{{$product->quantity}}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control" name="category_id">
            <option>Default select</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control" name="brand_id">
            <option>Default select</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control" name="status">
            <option>Default select</option>
          </select>
        </div>
      </div>

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

        @foreach($product->images as $image)
          <label>
            <img class="rounded float-left" src="{{asset('images/product/'.$image->image)}}" alt="{{$product->title}}" width="200" height="200"/>
            <input type="file" class="d-none" name="image[]">
          </label>
          <input type="hidden" class="d-none" name="imageID[]" value="{{$image->id}}">
        @endforeach

      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
    @else
    <h2>Invalid product</h2>
    @endif
  </div>
</div>
@endsection