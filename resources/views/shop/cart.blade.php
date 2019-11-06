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
              <h2>Cart</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="cart.html">Cart</a>
            </div>
          </div>
        </div>
      </div>
    </section>
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
                            <img src="{{asset('images/product/'.$image->image)}}" alt="{{$cart->product->title}}" width="145" height="98" />
                          </a>
                          @endif
                          @php --$i; @endphp
                          @endforeach
                        </div>
                        <div class="media-body"><p>{{$cart->product->title}}</p></div>
                      </div>
                    </td>
                    <td>
                      <h5 class="cart_single_price">{{$cart->product->offer_price}}</h5>
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
                      <h5 class="cart_single_total">{{$cart->price}}</h5>
                    </td>
                    <td>
                      <a href="{{route('cart.delete', $cart->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                  <tr class="bottom_button">
                    
                    <td colspan="1">
                      <div class="cupon_text">
                        <input type="text" placeholder="Coupon Code" />
                        <a class="main_btn" href="#">Apply</a>
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
                    <h5 id="subtotal_cart_price">0.00</h5>
                  </td>
                </tr>
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