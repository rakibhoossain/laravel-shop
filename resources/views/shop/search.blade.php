@extends('layouts.app')
@section('content')

@if($products)

<!--================Home Banner Area =================-->
@include('layouts.breadcrumb', ['title' => 'Search', 'description' => 'Results'])
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="product_top_bar">
          <div class="left_dorp">
            <select class="sorting">
              <option value="1">Default sorting</option>
              <option value="2">Default sorting 01</option>
              <option value="4">Default sorting 02</option>
            </select>
            <select class="show">
              <option value="1">Show 12</option>
              <option value="2">Show 14</option>
              <option value="4">Show 16</option>
            </select>
          </div>
        </div>

        <div class="latest_product_inner">
          <div class="row">
    
          @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  @php $i = 1; @endphp
                  @foreach($product->images as $image)
                    @if($i>0)
                      <img class="card-img" src="{{asset('images/product/thumb/'.$image->image)}}" alt="{{$product->title}}" />
                    @endif
                   @php --$i; @endphp
                  @endforeach
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
                    <span class="mr-4">${{$product->offer_price}}</span>
                    <del>${{$product->price}}</del>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          </div>

          <div class="row">
            <nav class="blog-pagination justify-content-center d-flex">
              {{$products->links()}}
            </nav>
          </div>

        </div>
      </div>

      <div class="col-lg-3">
        <div class="left_sidebar_area">
          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Browse Categories</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                <li>
                  <a href="#">Frozen Fish</a>
                </li>
                <li>
                  <a href="#">Dried Fish</a>
                </li>
                <li>
                  <a href="#">Fresh Fish</a>
                </li>
                <li>
                  <a href="#">Meat Alternatives</a>
                </li>
                <li>
                  <a href="#">Fresh Fish</a>
                </li>
                <li>
                  <a href="#">Meat Alternatives</a>
                </li>
                <li>
                  <a href="#">Meat</a>
                </li>
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Product Brand</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                <li>
                  <a href="#">Apple</a>
                </li>
                <li>
                  <a href="#">Asus</a>
                </li>
                <li class="active">
                  <a href="#">Gionee</a>
                </li>
                <li>
                  <a href="#">Micromax</a>
                </li>
                <li>
                  <a href="#">Samsung</a>
                </li>
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Color Filter</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                <li>
                  <a href="#">Black</a>
                </li>
                <li>
                  <a href="#">Black Leather</a>
                </li>
                <li class="active">
                  <a href="#">Black with red</a>
                </li>
                <li>
                  <a href="#">Gold</a>
                </li>
                <li>
                  <a href="#">Spacegrey</a>
                </li>
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Price Filter</h3>
            </div>
            <div class="widgets_inner">
              <div class="range_item">
                <div id="slider-range"></div>
                <div class="">
                  <label for="amount">Price : </label>
                  <input type="text" id="amount" readonly />
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Category Product Area =================-->
@else
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Search result not found!</h2>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@endsection