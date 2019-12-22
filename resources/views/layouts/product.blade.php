<div class="col-lg-{{$col}} col-md-6">
  <div class="single-product">
    <div class="product-img">
      @if($product->images)
      <img class="img-fluid w-100" src="{{asset('images/product/'.$size.'/'.$product->images[0]->image)}}" alt="{{$product->title}}" />
      @endif
      <div class="p_icon">
        <a href="{{route('shop.single', $product->slug)}}">
          <i class="ti-eye"></i>
        </a>
        <a href="{{route('cart.add', $product->slug)}}">
          <i class="ti-shopping-cart"></i>
        </a>
      </div>
    </div>
    <div class="product-btm">
      <a href="{{route('shop.single', $product->slug)}}" class="d-block">
        <h4>{{$product->title}}</h4>
      </a>
      <div class="mt-3">
        <span class="mr-4">{{Helper::currency_amount($product->offer_price)}}{{Helper::currency()}}</span>
        <del>{{Helper::currency_amount($product->price)}}{{Helper::currency()}}</del>
      </div>
    </div>
  </div>
</div>