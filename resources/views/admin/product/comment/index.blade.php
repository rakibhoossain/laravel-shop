@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Comments</h5>
  <div class="card-body">
    @if($comment)
      <table id="comment_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Author</th>
            <th>Content</th>
            <th>Response to</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    @else
      <h2>Comment Empty!</h2>
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


      $('#comment_table').DataTable( {
            ajax: '{{route('admin.comments.list')}}',
            columns: [
                { "data": null,"sortable": false, 
                  render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                  }  
                },
                { data: 'author' },
                { data: 'content' },
                { data: 'restonse_to' },
                { data: 'status' },
                { data: 'date' },
                { data: 'action', 'searchable': false, 'orderable': false }
            ],
        } );

  });
</script>
@endpush