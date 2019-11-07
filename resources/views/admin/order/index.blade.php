@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Orders</h5>
  <div class="card-body">
    @if(count($orders)>0)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Order</th>
          <th scope="col">Status</th>
          <th scope="col">Payment</th>

          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $order_count = 1; @endphp
        @foreach($orders as $order)

        <tr>
          <td scope="row">{{$order_count}}</td>
          <td>{{$order->order_number}}</td>

          <td>{{$order->status}}</td>
          <td>{{$order->payment_status}}</td>

          <td>{{$order->user->name}}</td>
          
          <td>{{$order->item_count}}</td>
          <td>{{$order->grand_total}}</td>

          <td>
            <a class="btn btn-primary" href="{{ route('admin.product.order.show', $order->id )}}">View</a>
          </td>

        </tr>
        @php ++$order_count; @endphp
        @endforeach

      </tbody>
    </table>
    @else
      <h2>Order Empty!</h2>
    @endif
  </div>
</div>
@endsection