@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Products</h5>
  <div class="card-body">


    @if($product)





      <table id="product_table" class="table table-striped table-hover">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Title</th>
            <th>Price</th>
            <th>Offer Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>








    @else
      <h2>No product found <a href="{{route('admin.product.create')}}">Add product</a></h2>
    @endif
  </div>
</div>
@endsection