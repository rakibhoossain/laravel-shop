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

    <form method="post" action="{{ route('admin.product.order.update',$order->id) }}">
      {{csrf_field()}}

      <div class="form-group">
        <label for="paymentStatus">Payment status</label>
        <select class="form-control" id="paymentStatus" name="payment_status">
          <option value="" disabled>Select option</option>
          <option value="paid" @if($order->payment->status == 'paid') selected @endif>Paid</option>
          <option value="unpaid" @if($order->payment->status == 'unpaid') selected @endif>Unpaid</option>
        </select>
      </div>

      <div class="form-group">
        <label for="OrderStatus">Order status</label>
        <select class="form-control" id="OrderStatus" name="order_status">
          <option value="" disabled>Select option</option>
          <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
          <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
          <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
          <option value="decline" @if($order->status == 'decline') selected @endif>Decline</option>
        </select>
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Update</button>
      </div>

    </form>
    @endif
  </div>
</div>
@endsection