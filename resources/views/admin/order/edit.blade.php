@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Order</th>
          <th scope="col">Name</th>

          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->order_number}}</td>
          <td>{{$order->user->name}}</td>
          
          <td>{{Helper::orderCount($order->id, $order->user->id)}}</td>
          <td>{{Helper::grandPrice($order->id, $order->user->id)}}</td>

        </tr>

      </tbody>
    </table>
    @endif
  </div>
</div>
@endsection