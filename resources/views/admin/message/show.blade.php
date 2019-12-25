@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Message</h5>
  <div class="card-body">
    @if($message)

<div class="text-center">From: {{$message->name}}({{$message->email}})</div>
<hr/>
<div>{{$message->message}}</div>

    @endif

  </div>
</div>
@endsection