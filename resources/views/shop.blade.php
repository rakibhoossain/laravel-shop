@extends('layouts.app')
@section('content')

@if($products)
<!--================Home Banner Area =================-->
@include('layouts.breadcrumb', ['title' => 'Shop', 'description' => 'Description'])
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
            @include('layouts.product', ['product' => $product])
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
        @include('shop.sidebar')
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
          <h2>No product found</h2>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@endsection