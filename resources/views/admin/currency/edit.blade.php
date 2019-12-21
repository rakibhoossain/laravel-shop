@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Edit currency</h5>
  <div class="card-body">
    <form method="post" action="{{ route('admin.currency.update', $currency->id) }}">
      {{csrf_field()}}
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputName" class="col-form-label">Name</label>
          <input id="inputName" type="text" name="name" class="form-control" value="{{$currency->name}}" placeholder="US Doller">
        </div>
        <div class="form-group col-md-2">
          <label for="inputCode" class="col-form-label">Code</label>
          <input id="inputCode" type="text" name="code" class="form-control" value="{{$currency->code}}" placeholder="USD">
        </div>
        <div class="form-group col-md-2">
          <label for="inputSymbol" class="col-form-label">Symbol</label>
          <input id="inputSymbol" type="text" name="symbol" class="form-control" value="{{$currency->symbol}}" placeholder="$">
        </div>
        <div class="form-group col-md-4">
          <label for="inputRate" class="col-form-label">Exchange Rate</label>
          <input id="inputRate" type="text" name="exchange_rate" class="form-control" value="{{$currency->exchange_rate}}" placeholder="78.00">
        </div>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection