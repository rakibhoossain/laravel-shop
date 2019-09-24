@extends('admin.index')
@section('content')
<div class="card">
  <h5 class="card-header">Products</h5>
  <div class="card-body">
    @if(count($products)>0)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Price</th>
          <th scope="col">Stock</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $product_count = 1; @endphp
        @foreach($products as $product)

        <tr>
          <td scope="row">{{$product_count}}</td>
          <td>{{$product->title}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->quantity}}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.product.edit', $product->id )}}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" href="#delModal{{$product->id}}">Delete</a>
          </td>

          <!-- Modal {{$product->id}} -->
          <div class="modal fade" id="delModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$product->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="#delModal{{$product->id}}Label">Delete product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{ route('admin.product.destroy',$product->id) }}">
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Parmanent Delete product</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </tr>
        @php ++$product_count; @endphp
        @endforeach

      </tbody>
    </table>
    @else
      <h2>No product found</h2>
    @endif
  </div>
</div>
@endsection