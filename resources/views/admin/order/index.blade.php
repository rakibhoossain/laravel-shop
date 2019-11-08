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
          <th scope="col">Payment status</th>
          <th scope="col">Payment method</th>

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
          <td>{{$order->payment->status}}</td>
          <td>{{$order->payment->payment_method}}</td>

          <td>{{$order->user->name}}</td>
          
          <td>{{Helper::orderCount($order->id, $order->user->id)}}</td>
          <td>{{Helper::grandPrice($order->id, $order->user->id)}}</td>

          <td>
            <a class="btn btn-primary" href="{{ route('admin.product.order.show', $order->id )}}">View</a>
          </td>

        </tr>
        @php ++$order_count; @endphp
        @endforeach

      </tbody>
    </table>


          <div class="row">
            <nav class="blog-pagination justify-content-center d-flex">
              {{$orders->links()}}
            </nav>
          </div>
    
    @else
      <h2>Order Empty!</h2>
    @endif
  </div>


</div>
@endsection