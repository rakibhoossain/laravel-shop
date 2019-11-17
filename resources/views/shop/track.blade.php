@extends('layouts.app')
@section('content')

    @section('title')
      Tracking order
    @endsection

    <!--================Home Banner Area =================-->
    @include('layouts.breadcrumb', ['title' => 'Tracking order', 'description' => 'Description'])
    <!--================End Home Banner Area =================-->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area section_gap">
        <div class="container">
            <div class="tracking_box_inner">
                <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given
                    to you on your receipt and in the confirmation email you should have received.</p>
                <form class="row tracking_form" action="{{route('shop.track.order')}}" method="post" novalidate="novalidate">
                  {{csrf_field()}}
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" id="order_number" name="order_number" placeholder="Order number">
                    </div>
{{--                     <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Billing Email Address">
                    </div> --}}
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="btn submit_btn">Track Order</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->

@endsection