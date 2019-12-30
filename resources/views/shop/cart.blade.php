@extends('layouts.app')
@section('content')

    <!--================Home Banner Area =================-->
    @include('layouts.breadcrumb', ['title' => 'Cart', 'description' => 'Results'])
    <!--================End Home Banner Area =================-->


    @if($carts)
    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="cart_inner">

          <div class="table-responsive">
            <table class="table w-100 d-block d-md-table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="cart_item_list">  

                <form method="post" action="{{ route('cart.update') }}">
                {{csrf_field()}}

                  @foreach($carts as $cart)
                  <tr class="single_cart_item">
                    <td>
                      <div class="media">
                        <div class="d-flex">
                          @php $i = 1; @endphp
                          @foreach($cart->product->images as $image)
                          @if($i>0)
                          <a href="{{route('shop.single', $cart->product->slug)}}">
                            <img src="{{asset('images/product/small/'.$image->image)}}" alt="{{$cart->product->title}}"/>
                          </a>
                          @endif
                          @php --$i; @endphp
                          @endforeach
                        </div>
                        <div class="media-body"><p>{{$cart->product->title}}</p></div>
                      </div>
                    </td>
                    <td>
                      <h5 class="cart_single_price"><span class="money">{{Helper::currency_amount($cart->product->offer_price)}}</span>{{Helper::currency()}}</h5>
                    </td>
                    <td>
                      <div class="product_count">
                        <input type="text" name="qty[]" maxlength="12" value="{{$cart->quantity}}" class="input-text qty"/>
                        <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
                        
                        <button class="cart_u increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button class="cart_u reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                      </div>
                    </td>
                    <td>
                      <h5 class="cart_single_total"><span class="money">{{Helper::currency_amount($cart->price)}}</span>{{Helper::currency()}}</h5>
                    </td>
                    <td>
                      <a href="{{route('cart.delete', $cart->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                  <tr class="bottom_button">
                    
                    <td colspan="1">
                      <div class="cupon_text">
                        <input type="text" placeholder="Coupon Code" id="coupon_code" />
                        <a class="main_btn" id="coupon_apply" href="#">Apply</a>
                      </div>
                    </td>
                    <td colspan="4" class="text-right">
                      <button type="submit" name="update_cart" class="gray_btn">Update Cart</button>
                    </td> 

                  </tr>
                </form>
                <tr>
                  <td colspan="3"></td>
                  <td>
                    <h5>Subtotal</h5>
                  </td>
                  <td>
                    <h5 id="subtotal_cart_price"><span class="money">0.00</span>{{Helper::currency()}}</h5>
                  </td>
                </tr>

                @if(session()->has('discount'))
                <tr>
                  <td colspan="3"></td>
                  <td>
                    <h5>Discount({{Session::get('discount')['code']}})</h5>
                  </td>
                  <td>
                    <h5 id="discount_price">-<span class="money">{{Helper::currency_amount(Session::get('discount')['value'])}}</span>{{Helper::currency()}}</h5>
                  </td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td>
                    <h5>Total</h5>
                  </td>
                  <td>
                    <h5 id="total_price"><span class="money">{{Helper::currency_amount(Session::get('discount')['value'])}}</span>{{Helper::currency()}}</h5>
                  </td>
                </tr>
                @endif


                <tr class="out_button_area">
                  <td colspan="5">
                    <div class="checkout_btn_inner">
                       <a class="gray_btn" href="{{route('shop')}}">Continue Shopping</a>
                      <a class="main_btn" href="{{route('cart.checkout')}}">Proceed to checkout</a>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>

          
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
    @endif
    
@endsection

@push('scripts')
  <script type="text/javascript">
  const url = "{{route('shop.coupon')}}";
  const redirect_url = "{{route('cart')}}";

  $('#coupon_apply').click(function(e){
    e.preventDefault();

    axios.post(url, {
      code: $('#coupon_code').val()
    })
    .then(function (response) {
      if(response.data == '1') window.location.href = redirect_url;
      else {$('#basicform').html(`<div class="alert alert-danger"><ul><li>Invalid Coupon</li></ul></div>`);}
    })
    .catch(function (error) {
      $('#basicform').html(`<div class="alert alert-danger"><ul><li>Invalid Coupon</li></ul></div>`);
    });
  });
  </script>
@endpush