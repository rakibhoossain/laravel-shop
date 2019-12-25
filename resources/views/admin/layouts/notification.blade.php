@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Notifications</h5>
  <div class="card-body">
    @if(count(Auth::user()->Notifications)>0)
    <table class="table table-striped table-hover admin-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Time</th>
          <th scope="col">Title</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( Auth::user()->Notifications as $notification)

        <tr class="@if($notification->unread()) bg-warning border-left-warning @else border-left-success @endif">
          <td scope="row">{{$loop->index +1}}</td>
          <td>{{$notification->created_at->format('F d, Y h:i A')}}</td>
          <td>{{$notification->data['title']}}</td>
          <td><a href="{{ route('admin.notification', $notification->id) }}" class="btn btn-dark">View</a> <a href="{{ route('admin.notification.delete', $notification->id) }}" class="btn btn-danger">Delete</a></td>

        </tr>

        @endforeach
      </tbody>
    </table>
    @else
      <h2>Notifications Empty!</h2>
    @endif
  </div>
</div>
@endsection