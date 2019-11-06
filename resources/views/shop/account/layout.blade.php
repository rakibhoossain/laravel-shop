@extends('layouts.app')
@section('content')

<section class="account_area section_gap">
  <div class="container">

    <div class="row">
      <div class="col-md-2">
        <div class="list-group">
          <a href="{{route('account')}}" class="list-group-item list-group-item-action active">Profile</a>
          <a href="{{route('account.order')}}" class="list-group-item list-group-item-action">Order</a>
        </div>
      </div>
      <div class="col-md-10">
        @yield('account')
      </div>
    </div>

  </div>
</section>

@endsection