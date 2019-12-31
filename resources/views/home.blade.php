@extends('layouts.app')
@section('title')
  Shop || home
@endsection
@section('content')
@push('styles')
  <link rel="stylesheet" href="{{ asset('vendors/OwlCarousel/assets/owl.carousel.min.css') }}" />
@endpush
<!--================Home Banner Area =================-->
@if(count($sliders)>0)
<section class="owl-carousel">
  @foreach($sliders as $slider)
  <div class="home_banner_area mb-40" style="background: url({{asset('images/slider/'.$slider->image)}}) no-repeat center;">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            {!!$slider->body!!}
            @if($slider->button && $slider->url)
            <a class="main_btn mt-40" href="{{$slider->url}}">{{$slider->button}}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</section>
@endif
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

<!--================ New Product Area =================-->
<section class="new_product_area section_gap_bottom_custom">
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
      @foreach(Helper::recentProduct() as $product)
        @include('layouts.product', ['product' => $product, 'size' => 'medium', 'col' => 3])
      @endforeach
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
@push('scripts')
<script src="{{ asset('vendors/OwlCarousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() { 

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    responsiveClass:false,
    items:1,
    autoplay:true,
    lazyLoad:true,
    autoplayHoverPause:true,
});

  });
</script>
@endpush 