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
            <a class="btn btn-primary" href="{{ route('admin.product.order.edit', $order->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$order->id}}">Delete</a>
          </td>

          <!-- Modal {{$order_count}} -->
{{--           <div class="modal fade" id="delModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$order->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$order->id}}Label">Delete brand</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.product.brand.destroy',$order->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent delete brand</button>
                  </form>
                </div>
              </div>
            </div>
          </div> --}}

        </tr>
        @php ++$order_count; @endphp
        @endforeach

      </tbody>
    </table>
    @else
      <h2>No brand found <a href="{{route('admin.product.brand.create')}}">Add brand</a></h2>
    @endif
  </div>
</div>
@endsection