@extends('shop.account.layout')
@section('account')

<div class="card">
  <h5 class="card-header">Order</h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Order</th>
          <th scope="col">Status</th>
          <th scope="col">Payment</th>

          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>{{$order->order_number}}</td>

          <td>{{$order->status}}</td>
          <td>{{$order->payment_status}}</td>

          <td>{{$order->user->name}}</td>
          
          <td>{{$order->item_count}}</td>
          <td>{{$order->grand_total}}</td>

      </tbody>
    </table>
    @endif
  </div>
</div>

@endsection