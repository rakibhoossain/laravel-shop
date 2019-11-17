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