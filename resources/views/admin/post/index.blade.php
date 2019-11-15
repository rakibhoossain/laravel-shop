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