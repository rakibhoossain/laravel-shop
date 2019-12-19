@extends('layouts.app')
@section('title')
  Shop || home
@endsection
@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40" style="background: url({{asset('img/banner/banner-bg.jpg')}}) no-repeat center;">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content row">
        <div class="col-lg-12">
          <p class="sub text-uppercase">men Collection</p>
          <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
          <h4>Fowl saw dry which a above together place.</h4>
          <a class="main_btn mt-40" href="#">View Collection</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!-- Start feature Area -->
<section class="feature-area section_gap_bottom_custom">
  <div class="container">
    <div class="row">

    @foreach(Helper::get_widget('feature') as $feature)
      {!!$feature->content!!}
    @endforeach

    </div>
  </div>
</section>
<!-- End feature Area -->

<!--================ Feature Product Area =================-->
<section class="feature_product_area section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Featured product</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach($products as $product)
        @include('layouts.product', ['product' => $product, 'size' => 'thumb', 'col' => 4])
      @endforeach
    </div>
  </div>
</section>
<!--================ End Feature Product Area =================-->

<!--================ Offer Area =================-->
<section class="offer_area" style="background: url({{asset('img/offer-bg.png')}}) no-repeat center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="offset-lg-4 col-lg-6 text-center">
        <div class="offer_content">
          <h3 class="text-uppercase mb-40">all men’s collection</h3>
          <h2 class="text-uppercase">50% off</h2>
          <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>
          <p>Limited Time Offer</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Offer Area =================-->

<!--================ New Product Area =================-->
<section class="new_product_area section_gap_top section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>new products</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="new_product">
          <h5 class="text-uppercase">collection of 2019</h5>
          <h3 class="text-uppercase">Men’s summer t-shirt</h3>
          <div class="product-img">
            <img class="img-fluid" src="img/product/new-product/new-product1.png" alt="" />
          </div>
          <h4>$120.70</h4>
          <a href="#" class="main_btn">Add to cart</a>
        </div>
      </div>

      <div class="col-lg-6 mt-5 mt-lg-0">
        <div class="row">
          @foreach(Helper::recentProduct() as $product)
            @include('layouts.product', ['product' => $product, 'size' => 'medium', 'col' => 6])
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End New Product Area =================-->

<!--================ Inspired Product Area =================-->
<section class="inspired_product_area section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Inspired products</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach(Helper::inspireProduct() as $product)
        @include('layouts.product', ['product' => $product, 'size' => 'medium', 'col' => 3])
      @endforeach
    </div>
  </div>
</section>
<!--================ End Inspired Product Area =================-->

<!--================ Start Blog Area =================-->
<section class="blog-area section-gap">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>latest blog</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach($posts as $post)
      <div class="col-lg-4 col-md-6">
        <div class="single-blog">
          <div class="thumb">
            @if($post->image)
              <img class="img-fluid" src="{{asset('images/post/thumb/'.$post->image)}}" alt="{{$post->title}}">
            @endif
          </div>
          <div class="short_details">
            <div class="meta-top d-flex">
              <a href="{{route('post.user', $post->user->id)}}">By {{$post->user->name}}</a>
              <a href="{{route('post.single', $post->slug)}}#comments-area"><i class="ti-comments-smiley"></i>{{count($post->allComments)}} Comments</a>
            </div>
            <a class="d-block" href="{{route('post.single', $post->slug)}}">
              <h4>{{$post->title}}</h4>
            </a>
            <div class="text-wrap">
              {{Str::words(strip_tags($post->body),16)}}
            </div>
            <a href="{{route('post.single', $post->slug)}}" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!--================ End Blog Area =================-->
@endsection