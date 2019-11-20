@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Users</h5>
  <div class="card-body">
    @if($users)
      <table id="user_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Name</th>
            <th>Email</th>
            <th>Join date</th>
            <th>Admin</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    @else
      <h2>No user found!</h2>
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

      $('#user_table').DataTable( {
            ajax: '{{route('admin.user.list')}}',
            columns: [
                { "data": null,"sortable": false, 
                  render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                  }  
                },
                { data: 'name' },
                { data: 'email' },
                { data: 'created_at' },
                { data: 'admin_status' },
                { data: 'action', 'searchable': false, 'orderable': false }

            ],
        } );

  });
</script>
@endpush