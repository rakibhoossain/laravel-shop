@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Products</h5>
  <div class="card-body">
    @if($product)
      <table id="product_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Image</th>
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

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#product_table').DataTable( {
            ajax: '{{route('admin.product.list')}}',
            columns: [
                { "data": null,"sortable": false, 
                  render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                  }  
                },
                { data: 'image' },
                { data: 'title' },
                { data: 'price' },
                { data: 'offer_price' },
                { data: 'quantity' },
                { data: 'action', 'searchable': false, 'orderable': false }
            ],
        } );

  });
</script>
@endpush