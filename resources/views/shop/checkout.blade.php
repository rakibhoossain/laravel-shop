@extends('layouts.app')
@section('content')

    <!--================Home Banner Area =================-->
    @include('layouts.breadcrumb', ['title' => 'Product Checkout', 'description' => 'Results'])
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">
        <div class="cupon_area">
          <div class="check_title">
            <h2>
              Have a coupon?
              <label for="checkout_coupon">Click here to enter your code</label>
            </h2>
          </div>
          <input type="text" id="checkout_coupon" placeholder="Enter coupon code" />
          <a class="tp_btn" href="#">Apply Coupon</a>
        </div>



        <form class="" action="{{ route('cart.order') }}" method="post">
        {{csrf_field()}}
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Billing Details</h3>




              <div class="row contact_form">
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="first_name" placeholder="First name"/>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="last_name" placeholder="Last name"/>
                </div>
{{--                 <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="company"
                    name="company"
                    placeholder="Company name"
                  />
                </div> --}}
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="phone_number" placeholder="Phone number"/>
                </div>
{{--                 <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="compemailany" />
                  <span class="placeholder" data-placeholder="Email Address" ></span>
                </div> --}}


                <div class="col-md-12 form-group p_star">
                  <select class="country_select" name="country">
                    <option value="1">Country</option>
                    <option value="2">Country</option>
                    <option value="4">Country</option>
                  </select>
                </div>
                <div class="col-md-12 form-group p_star">
                  <select class="country_select" name="city">
                    <option value="1">District</option>
                    <option value="2">District</option>
                    <option value="4">District</option>
                  </select>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" name="city" placeholder="Town/City"/>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" name="address" placeholder="Address"/>
                </div>


                <div class="col-md-12 form-group">
                  <input type="text" class="form-control" name="post_code" placeholder="Postcode/ZIP"/>
                </div>

                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <h3>Shipping Details</h3>
                    <input type="checkbox" id="f-option3" name="selector" />
                    <label for="f-option3">Ship to a different address?</label>
                  </div>
                  <textarea class="form-control" name="notes" rows="1" placeholder="Order Notes"></textarea>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="order_box">
                <h2>Your Order</h2>
                <ul class="list">
                  <li>
                    <a href="{{route('cart')}}">
                      Product <span>Total</span>
                    </a>
                  </li>

                  @foreach($orders as $order)
                  <li>
                    <a href="{{route('shop.single', $order->product->slug)}}">{{$order->product->title}}
                      <span class="middle">x {{$order->quantity}}</span>
                      <span class="last">{{$order->price}}{{Helper::currency()}}</span>
                    </a>
                  </li>
                  @endforeach

                </ul>
                <ul class="list list_2">
                  <li class="order_sutotal" data-price="{{$total_price}}" data-currency="{{Helper::currency()}}">
                    <a href="{{route('cart')}}">
                      Subtotal <span>{{$total_price}}{{Helper::currency()}}</span>
                    </a>
                  </li>
                  <li class="shipping">
                    <span>Shipping</span>
                    <div class="input-group-icon">
                      <div class="icon">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                      </div>
                      <div class="form-select">
                        <select name="shipping">
                          <option value="">Select</option>
                          @foreach(Helper::shiping() as $shiping)
                          <option value="{{$shiping->id}}" data-price="{{$shiping->price}}">{{$shiping->type}}: {{$shiping->price}}{{Helper::currency()}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </li>
                  <li id="order_total_price">
                    <a href="{{route('cart')}}">
                      Total <span>{{$total_price}}{{Helper::currency()}}</span>
                    </a>
                  </li>
                </ul>



{{--                 <div class="payment_item active">

                  <p>
                    Please send a check to Store Name, Store Street, Store Town,
                    Store State / County, Store Postcode.
                  </p>
                </div> --}}

                <div class="payment_item">
                  <div class="radion_btn">
                    <input type="radio" id="f-cashon" name="paymentoption" value="cash"/>
                    <label for="f-cashon">Cash on Delivery </label>
                    <img src="{{asset('img/product/single-product/card.jpg')}}" alt="" />
                    <div class="check"></div>
                  </div>
                  <div class="radion_btn">
                    <input type="radio" id="f-bkash" name="paymentoption" value="bKash"/>
                    <label for="f-bkash">bKash </label>
                    <img src="{{asset('img/product/single-product/card.jpg')}}" alt="" />
                    <div class="check"></div>
                  </div>
                  <div class="radion_btn">
                    <input type="radio" id="f-rocket" name="paymentoption"  value="rocket"/>
                    <label for="f-rocket">Rocket </label>
                    <img src="{{asset('img/product/single-product/card.jpg')}}" alt="" />
                    <div class="check"></div>
                  </div>

                  <div class="paymentoption">


                    <div class="bKash">
                      <p>Bkash</p>
                    </div>

                    <div class="rocket">
                        <p>rocket</p>
                    </div>

                    <div class="mt-10 mb-10">
                        <input type="text" name="transectionId" placeholder="Transaction ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Transaction ID'" class="single-input">
                    </div>
                  </div>

                  <div class="cashondelivary">
                    <p>cashondelivary</p>
                  </div>
                </div>


<style type="text/css">

/*.order_box .list_2 li a {
    text-transform: uppercase;
    color: #2a2a2a;
    font-weight: 500;
}*/


.order_box .list_2 li.shipping {
  display: inline-flex;
  width: 100%;
  font-size: 14px;
  border-bottom: 1px solid #eeeeee;
  justify-content: space-between;
}
.order_box .list_2 li.shipping span{
  color: #2a2a2a;
  text-transform: uppercase;
  font-weight: 500;
}
.order_box .list_2 li.shipping>span {
    line-height: 40px;
}
.order_box .list_2 li.shipping .input-group-icon {
    width: 100%;
    margin-left: 10px;
}
.form-select .nice-select .list {
    z-index: 99;
}

</style>







{{--                 <div class="payment_item active">

                  <p>
                    Please send a check to Store Name, Store Street, Store Town,
                    Store State / County, Store Postcode.
                  </p>
                </div> --}}



                <div class="creat_account">
                  <input type="checkbox" id="condition" name="condition" />
                  <label for="condition">I’ve read and accept the </label>
                  <a href="#">terms & conditions*</a>
                </div>
                <button class="main_btn" type="submit">Proceed</button>
              </div>
            </div>
          </div>
        </div>

        </form>






      </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection