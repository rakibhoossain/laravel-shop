@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit shipping</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.shipping.update', $shipping->id) }}">
      {{csrf_field()}}
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputType" class="col-form-label">Type</label>
          <input id="inputType" type="text" name="type" class="form-control" value="{{$shipping->type}}" placeholder="Free">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPrice" class="col-form-label">Cost</label>
          <input id="inputPrice" type="text" name="price" placeholder="00.00" class="form-control" value="{{$shipping->price}}">
        </div>
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3">{{$shipping->description}}</textarea>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection