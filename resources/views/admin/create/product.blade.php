@extends('admin.index')
@section('content')
<div class="section-block" id="basicform">

  @if ($message = Session::get('success'))

  <div class="alert alert-success alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button>

    <strong>{{ $message }}</strong>

  </div>

  @endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>




<div class="card">
  <h5 class="card-header">Product insert</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title</label>
        <input id="inputTitle" type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3"></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputPrice" class="col-form-label">Price</label>
          <input id="inputPrice" type="number" name="price" class="form-control" placeholder="Numbers">
        </div>
        <div class="form-group col-md-4">
          <label for="inputOfferPrice" class="col-form-label">Offer price</label>
          <input id="inputOfferPrice" type="number" name="offer_price" class="form-control" placeholder="Numbers">
        </div>
        <div class="form-group col-md-4">
          <label for="inputQuantity" class="col-form-label">Quantity</label>
          <input id="inputQuantity" type="number" name="quantity" class="form-control" placeholder="Numbers">
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

      <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" name="image" id="inputImage">
        <label class="custom-file-label" for="inputImage">File Input</label>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
  </div>
</div>
@endsection