@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Orders</h5>
  <div class="card-body">
    @if($order)
      <table id="order_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Order</th>
            <th>Status</th>
            <th>Payment status</th>
            <th>Payment method</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    @else
      <h2>Order Empty!</h2>
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

    $('#order_table').DataTable( {
        ajax: '{{route('admin.product.order.list')}}',
        columns: [
            { "data": null,"sortable": false, 
              render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
              }  
            },
            { data: 'order_number' },
            { data: 'status' },
            { data: 'payment_status' },
            { data: 'payment_method' },
            { data: 'name' },
            { data: 'order_count' },
            { data: 'grand_price' },
            { data: 'action', 'searchable': false, 'orderable': false }
        ],
    } );

  });
</script>
@endpush