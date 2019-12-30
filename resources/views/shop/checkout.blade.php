@extends('layouts.app')
@section('content')
  @push('styles')
  <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}" />
  @endpush  
    <!--================Home Banner Area =================-->
    @include('layouts.breadcrumb', ['title' => 'Product Checkout', 'description' => 'Results'])
    <!--================End Home Banner Area =================-->
  <style type="text/css">
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
    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">
        <div class="cupon_area">
          <div class="check_title">
            <h2 id="coupon_title">
              Have a coupon?
              <label for="coupon_code">Click here to enter your code</label>
            </h2>
          </div>
          <div id="coupon_input">
            <input type="text" id="coupon_code" placeholder="Enter coupon code" />
            <a class="tp_btn" href="#" id="coupon_apply">Apply Coupon</a>
          </div>
        </div>
        <form class="" action="{{ route('cart.order') }}" method="post">
        {{csrf_field()}}
          <div class="billing_details">
            <div class="row">
              <div class="col-lg-8">
                <h3>Shipping Details</h3>

                <div class="row contact_form">
                  <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{Helper::user_address('first_name', auth()->user()->id)}}" />
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{Helper::user_address('last_name', auth()->user()->id)}}"/>
                  </div>

                  <div class="col-md-12 form-group p_star">
                    <select class="select2" name="country" style="width:100%;">
                      <option value="Bangladesh">Bangladesh</option>
                    </select>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <select class="select2" name="city" style="width:100%;">
                      <option value="">Select city</option>
                      @foreach(Helper::cities() as $city)
                      <option value="{{$city->id}}" @if(Helper::user_address('city_id', auth()->user()->id) == $city->id) selected @endif>{{$city->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{Helper::user_address('address', auth()->user()->id)}}"/>
                  </div>
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="post_code" placeholder="Postcode/ZIP" value="{{Helper::user_address('post_code', auth()->user()->id)}}"/>
                  </div>
                  <div class="col-md-12 form-group">
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
                        <span class="last">{{Helper::currency_amount($order->price)}}{{Helper::currency()}}</span>
                      </a>
                    </li>
                    @endforeach

                  </ul>
                  <ul class="list list_2">
                    <li class="order_sutotal" data-price="{{Helper::currency_amount($total_price)}}" data-currency="{{Helper::currency()}}">
                      <a href="{{route('cart')}}">
                        Subtotal <span>{{Helper::currency_amount($total_price)}}{{Helper::currency()}}</span>
                      </a>
                    </li>
                    <li class="shipping">
                      <span>Shipping</span>
                      <div class="input-group-icon">
                        <div class="icon">
                          <i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <div class="form-select">
                          <select name="shipping" class="nice-select">
                            <option value="">Select</option>
                            @foreach(Helper::shiping() as $shiping)
                            <option value="{{$shiping->id}}" data-price="{{Helper::currency_amount($shiping->price)}}">{{$shiping->type}}: {{Helper::currency_amount($shiping->price)}}{{Helper::currency()}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </li>

                    @if(session()->has('discount'))
                    <li>
                      <a href="{{route('cart')}}">
                        Discount({{Session::get('discount')['code']}}) <span>-{{Helper::currency_amount(Session::get('discount')['value'])}}{{Helper::currency()}}</span>
                      </a>                    
                    </li>            
                    <li id="order_total_price">
                      <a href="{{route('cart')}}">
                        Total <span>{{Helper::currency_amount($total_price-Session::get('discount')['value'])}}{{Helper::currency()}}</span>
                      </a>
                    </li>
                    @else
                    <li id="order_total_price">
                      <a href="{{route('cart')}}">
                        Total <span>{{Helper::currency_amount($total_price)}}{{Helper::currency()}}</span>
                      </a>
                    </li>
                    @endif
                  </ul>

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

@push('scripts')
<script src="{{ asset('vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() { $("select.select2").select2(); });
  $('select.nice-select').niceSelect();

  const url = "{{route('shop.coupon')}}";
  const redirect_url = "{{route('cart.checkout')}}";
  
  $('#coupon_input').hide();
  $('#coupon_title>label').click(function(){
    $('#coupon_input').slideToggle( "slow" );
  });
  
  $('#coupon_apply').click(function(e){
    e.preventDefault();

    axios.post(url, {
      code: $('#coupon_code').val()
    })
    .then(function (response) {
       window.location.href = redirect_url;
    })
    .catch(function (error) {
      $('#basicform').html(`<div class="alert alert-danger"><ul><li>Invalid Coupon</li></ul></div>`);
    });
  });
</script>
@endpush  