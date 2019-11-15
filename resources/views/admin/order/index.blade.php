@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Orders</h5>
  <div class="card-body">
    @if($order)
      <table id="order_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Order</th>
            <th>Status</th>
            <th>Payment status</th>
            <th>Payment method</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    @else
      <h2>Order Empty!</h2>
    @endif
  </div>
</div>
@endsection