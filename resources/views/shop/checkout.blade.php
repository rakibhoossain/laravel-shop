@extends('layouts.app')
@section('content')

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Product Checkout</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="checkout.html">Product Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
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
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Billing Details</h3>
              <form class="row contact_form" action="{{ route('cart.order') }}" method="post">
                {{csrf_field()}}
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="first_name" />
                  <span class="placeholder" data-placeholder="First name"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" name="last_name" />
                  <span class="placeholder" data-placeholder="Last name"></span>
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
                  <input type="text" class="form-control" name="phone_number" />
                  <span class="placeholder" data-placeholder="Phone number" ></span>
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
                  <input type="text" class="form-control" name="city" />
                  <span class="placeholder" data-placeholder="Town/City"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" name="address"/>
                  <span class="placeholder" data-placeholder="Address"></span>
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

<button type="submit">Send</button>

              </form>




            </div>
            <div class="col-lg-4">
              <div class="order_box">
                <h2>Your Order</h2>
                <ul class="list">
                  <li>
                    <a href="#"
                      >Product
                      <span>Total</span>
                    </a>
                  </li>

                  @foreach($orders as $order)
                  <li>
                    <a href="{{route('shop.single', $order->product->slug)}}">{{$order->product->title}}
                      <span class="middle">x {{$order->quantity}}</span>
                      <span class="last">{{$order->price}}</span>
                    </a>
                  </li>
                  @endforeach

                </ul>
                <ul class="list list_2">
                  <li>
                    <a href="#"
                      >Subtotal
                      <span>{{$total_price}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Shipping
                      <span>Flat rate: $50.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Total
                      <span>$2210.00</span>
                    </a>
                  </li>
                </ul>
                <div class="payment_item">
                  <div class="radion_btn">
                    <input type="radio" id="f-option5" name="selector" />
                    <label for="f-option5">Check payments</label>
                    <div class="check"></div>
                  </div>
                  <p>
                    Please send a check to Store Name, Store Street, Store Town,
                    Store State / County, Store Postcode.
                  </p>
                </div>
                <div class="payment_item active">
                  <div class="radion_btn">
                    <input type="radio" id="f-option6" name="selector" />
                    <label for="f-option6">Paypal </label>
                    <img src="{{asset('img/product/single-product/card.jpg')}}" alt="" />
                    <div class="check"></div>
                  </div>
                  <p>
                    Please send a check to Store Name, Store Street, Store Town,
                    Store State / County, Store Postcode.
                  </p>
                </div>
                <div class="creat_account">
                  <input type="checkbox" id="f-option4" name="selector" />
                  <label for="f-option4">I’ve read and accept the </label>
                  <a href="#">terms & conditions*</a>
                </div>
                <a class="main_btn" href="#">Proceed to Paypal</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection