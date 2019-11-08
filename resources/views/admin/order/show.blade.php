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
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->order_number}}</td>
          <td>{{$order->user->name}}</td>
          
          <td>{{Helper::orderCount($order->id)}}</td>
          <td>{{Helper::grandPrice($order->id)}}</td>
          
          <td>
            <a class="btn btn-primary" href="{{ route('admin.product.order.edit', $order->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal2">Delete</a>
          </td>
        </tr>

      </tbody>
    </table>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Product name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->cart as $cart)
        <tr>
          <td>{{$cart->product->title}}</td>
          <td>{{$cart->quantity}}</td>
          <td>{{$cart->price}}</td>
        </tr>
      @endforeach

      </tbody>
    </table>
    @endif
  </div>
</div>
@endsection