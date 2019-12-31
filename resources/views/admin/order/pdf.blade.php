<!DOCTYPE html>
<html>
<head>
  <title>Order @if($order)- {{$order->order_number}} @endif</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

@if($order)
<style type="text/css">
  .invoice-header {
    background: #f7f7f7;
    padding: 10px 20px 10px 20px;
    border-bottom: 1px solid gray;
  }
  .site-logo {
    margin-top: 20px;
  }
  .invoice-right-top h3 {
    padding-right: 20px;
    margin-top: 20px;
    color: #ec5d01;
    font-size: 30px!important;
    font-family: serif;
  }
  .invoice-left-top {
    border-left: 4px solid #ec5d00;
    padding-left: 20px;
    padding-top: 20px;
  }
  .invoice-left-top p {
    margin: 0;
    line-height: 20px;
    font-size: 16px;
    margin-bottom: 3px;
  }
  thead {
    background: #ec5d01;
    color: #FFF;
  }
  .authority h5 {
    margin-top: -10px;
    color: #ec5d01;
  }
  .thanks h4 {
    color: #ec5d01;
    font-size: 25px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
  }
  .site-address p {
    line-height: 6px;
    font-weight: 300;
  }
  .table tfoot .empty {
    border: none;
  }
  .table-bordered {
    border: none;
  }
  .table-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
  }
  .table td, .table th {
    padding: .30rem;
  }
</style>
  <div class="invoice-header">
    <div class="float-left site-logo">
      <img src="{{Storage::disk('public')->url(setting('logo'))}}" alt="">
    </div>
    <div class="float-right site-address">
      <h4>{{setting('app_name')}}</h4>
      <p>{{setting('shop_address')}}</p>
      <p>Phone: <a href="tel:{{setting('app_phone')}}">{{setting('app_phone')}}</a></p>
      <p>Email: <a href="mailto:{{setting('app_email')}}">{{setting('app_email')}}</a></p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="invoice-description">
    <div class="invoice-left-top float-left">
      <h6>Invoice to</h6>
       <h3>{{$order->first_name}} {{$order->last_name}}</h3>
       <div class="address">
        <p>
          <strong>City: </strong>
          {{App\City::findById($order->city_id)->name}}
        </p>
        <p>
          <strong>Address: </strong>
          {{ $order->address }}
        </p>
         <p><strong>Phone:</strong> {{ $order->phone_number }}</p>
         <p><strong>Email:</strong> {{ $order->user->email }}</p>
       </div>
    </div>
    <div class="invoice-right-top float-right" class="text-right">
      <h3>Invoice #{{$order->order_number}}</h3>
      <p>{{ $order->created_at }}</p>
      <img class="img-responsive" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate(route('admin.product.order.show', $order->id )))}}">
    </div>
    <div class="clearfix"></div>
  </div>
  <section class="order_details">
    <div class="table-header">
      <h5>Order Details</h5>
    </div>
    <table class="table table-bordered table-stripe">
      <thead>
        <tr>
          <th scope="col" class="col-6">Product</th>
          <th scope="col" class="col-3">Quantity</th>
          <th scope="col" class="col-3">Total</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->cart as $cart)
        <tr>
          <td><span>{{$cart->product->title}}</span></td>
          <td>x{{$cart->quantity}}</td>
          <td><span>{{$cart->price}}{{Helper::base_currency()}}</span></td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Subtotal:</th>
          <th scope="col"> <span>{{Helper::orderPrice($order->id, $order->user->id)}}{{Helper::base_currency()}}</span></th>
        </tr>
      @if(!empty($order->coupon))
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Discount:</th>
          <th scope="col"><span>-{{$order->coupon->discount(Helper::orderPrice($order->id, $order->user->id))}}{{Helper::base_currency()}}</span></th>
        </tr>
      @endif
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right ">Shipping:</th>
          <th><span>{{$order->shipping->price}}{{Helper::base_currency()}}</span></th>
        </tr>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Total:</th>
          <th>
            <span>
          @if(!empty($order->coupon)) 
            {{Helper::grandPrice($order->id, $order->user->id)-($order->coupon->discount(Helper::orderPrice($order->id, $order->user->id)))}}{{Helper::base_currency()}}
          @else
            {{Helper::grandPrice($order->id, $order->user->id)}}{{Helper::base_currency()}}
          @endif
            </span>
          </th>
        </tr>
      </tfoot>
    </table>
  </section>
  <div class="thanks mt-3">
    <h4>Thank you for your business !!</h4>
  </div>
  <div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
  <div class="clearfix"></div>
@else
  <h5 class="text-danger">Invalid</h5>
@endif
</body>
</html>