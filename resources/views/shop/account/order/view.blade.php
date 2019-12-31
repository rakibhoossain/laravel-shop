@extends('shop.account.layout')
@section('account')



@if($order)
<section class="confirmation_part section_padding">
  <div class="order_boxes">
    <div class="row">
      <div class="col-lg-12">
        <div class="confirmation_tittle">
          {{-- <span>Thank you. Your order has been received.</span> --}}
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>order info</h4>
          <ul>
            <li>
              <p>order number</p><span>: {{$order->order_number}}</span>
            </li>
            <li>
              <p>data</p><span>: {{$order->updated_at}}</span>
            </li>
            <li>
              <p>total</p><span>: {{Helper::currency_amount(Helper::grandPrice($order->id, $order->user->id))}}{{Helper::currency()}}</span>
            </li>
            <li>
              <p>payment method</p><span>: {{$order->payment->payment_method}}</span>
            </li>
            @if($order->payment->payment_method === 'bKash' || $order->payment->payment_method === 'rocket')
              <li>
                <p>transection Id</p><span>: {{$order->payment->transection_id}}</span>
              </li>
            @endif
            <li>
              <p>payment status</p><span>: {{$order->payment->status}}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>shipping Address</h4>
          <ul>
            <li>
              <p>Name</p><span>: {{$order->first_name}} {{$order->last_name}}</span>
            </li>
            <li>
              <p>Address</p><span>: {{$order->address}}</span>
            </li>
            <li>
              <p>City</p><span>: {{App\City::findById($order->city_id)->name}}</span>
            </li>
            <li>
              <p>Country</p><span>: {{$order->country}}</span>
            </li>
            <li>
              <p>Postcode</p><span>: {{$order->post_code}}</span>
            </li>
            <li>
              <p>Phone number</p><span>: {{$order->phone_number}}</span>
            </li>
            <li>
              <p>Email</p><span>: @auth {{ Auth::user()->email }} @endauth</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="order_details_iner">
          <h3>Order Details</h3>
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col" colspan="2">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>

            @foreach($order->cart as $cart)
              <tr>
                <td colspan="2"><span>{{$cart->product->title}}</span></td>
                <td>x{{$cart->quantity}}</td>
                <td><span>{{Helper::currency_amount($cart->price)}}{{Helper::currency()}}</span></td>
              </tr>
            @endforeach

              <tr>
                <th colspan="3">Subtotal</th>
                <th> <span>{{Helper::currency_amount(Helper::orderPrice($order->id, $order->user->id))}}{{Helper::currency()}}</span></th>
              </tr>
              @if(!empty($order->coupon))
              <tr>
                <th colspan="3">Discount</th>
                <th><span>-{{Helper::currency_amount($order->coupon->discount(Helper::orderPrice($order->id, $order->user->id)))}}{{Helper::currency()}}</span></th>
              </tr>                 
              @endif
              <tr>
                <th colspan="3">Shipping</th>
                <th><span>{{$order->shipping->type}} rate: {{Helper::currency_amount($order->shipping->price)}}{{Helper::currency()}}</span></th>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col" colspan="2">Quantity:</th>
                <th scope="col">x{{ Helper::orderCount($order->id)}}</th>
                <th scope="col">Total: 
                  @if(!empty($order->coupon)) 
                    {{Helper::currency_amount(Helper::grandPrice($order->id, $order->user->id)-($order->coupon->discount(Helper::orderPrice($order->id, $order->user->id))))}}{{Helper::currency()}}
                  @else
                    {{Helper::currency_amount(Helper::grandPrice($order->id, $order->user->id))}}{{Helper::currency()}}
                  @endif
                </th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@endsection