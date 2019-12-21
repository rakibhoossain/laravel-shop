@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Add shipping</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.shipping.store') }}">
      {{csrf_field()}}
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputType" class="col-form-label">Type</label>
          <input id="inputType" type="text" name="type" class="form-control" placeholder="Free">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPrice" class="col-form-label">Cost</label>
          <input id="inputPrice" type="text" name="price" placeholder="00.00" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea class="form-control" id="inputDescription" name="description" rows="3"></textarea>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Add shipping</button>
      </div>
    </form>
  </div>
</div>
@endsection