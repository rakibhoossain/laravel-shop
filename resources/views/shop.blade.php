@extends('layouts.app')
@section('content')

@if($products)
<!--================Home Banner Area =================-->
@include('layouts.breadcrumb', ['title' => 'Shop', 'description' => 'Description'])
<!--================End Home Banner Area =================-->
<form method="post" action="{{ route('shop.filter') }}" enctype="multipart/form-data">
  {{csrf_field()}}
<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="product_top_bar">
          <div class="left_dorp">

            <select class="sorting" name="sortBy" onchange="this.form.submit();">
              <option value="">Default sorting</option>
              <option value="price" @if( !empty($_GET['sortBy']) && $_GET['sortBy'] =='price' ) selected @endif>Price</option>
              <option value="brand" @if( !empty($_GET['sortBy']) && $_GET['sortBy'] =='brand' ) selected @endif>Brand</option>
              <option value="category" @if( !empty($_GET['sortBy']) && $_GET['sortBy'] =='category' ) selected @endif>Category</option>
            </select>
            <select class="show" name="show" onchange="this.form.submit();">
              <option value="6" @if( !empty($_GET['show']) && $_GET['show'] =='6' ) selected @endif>Show 6</option>
              <option value="9" @if( !empty($_GET['show']) && $_GET['show'] =='9' ) selected @endif>Show 9</option>
              <option value="12" @if( !empty($_GET['show']) && $_GET['show'] =='12' ) selected @endif>Show 12</option>
              <option value="15" @if( !empty($_GET['show']) && $_GET['show'] =='15' ) selected @endif>Show 15</option>
            </select>
          </div>
        </div>

        <div class="latest_product_inner">
          <div class="row">
    
          @foreach($products as $product)
            @include('layouts.product', ['product' => $product, 'size' => 'medium', 'col' => 4])
          @endforeach
          <!-- <product-item v-for="(product, index) in products" :data="product" :key="index"/> -->
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
</form>
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