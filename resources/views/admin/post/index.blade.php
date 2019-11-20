@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Posts</h5>
  <div class="card-body">
    @if($post)
      <table id="post_table" class="table table-striped table-hover admin-table">
        <thead>
          <tr>
            <th>S\N:</th>
            <th>Title</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    @else
      <h2>No post found <a href="{{route('admin.post.create')}}">Add post</a></h2>
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

      $('#post_table').DataTable( {
          ajax: '{{route('admin.post.list')}}',
          columns: [
              { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
                }  
              },
              { data: 'title' },
              { data: 'action', 'searchable': false, 'orderable': false }
          ],
      } ); 

  });
</script>
@endpush