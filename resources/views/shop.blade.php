@extends('layouts.app')
@section('content')

@if($products)
<!--================Home Banner Area =================-->
@include('layouts.breadcrumb', ['title' => 'Shop', 'description' => 'Description'])
<!--================End Home Banner Area =================-->
<form method="post" id="product_filter_form" action="{{ route('shop.filter') }}" enctype="multipart/form-data">
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
              <option value="">Default</option>
              <option value="1" @if( !empty($_GET['show']) && $_GET['show'] =='1' ) selected @endif>Show 1</option>
              <option value="2" @if( !empty($_GET['show']) && $_GET['show'] =='2' ) selected @endif>Show 2</option>
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
              {{$products->appends($_GET)->links()}} 
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

@push('scripts')
<script src="{{ asset('vendors/jquery-ui/jquery-ui.js') }}"></script>
<script type="text/javascript">

$(document).ready(function(){
  /*----------------------------------------------------*/
  /*  Jquery Ui slider js
  /*----------------------------------------------------*/
  if ($("#slider-range").length > 0) {
      const max_value = parseInt( $("#slider-range").data('max') ) || 500;
      const min_value = parseInt($("#slider-range").data('min')) || 0;
      const currency = $("#slider-range").data('currency') || '';
      let price_range = min_value+'-'+max_value;

      if($("#price_range").length > 0 && $("#price_range").val()){
          price_range = $("#price_range").val().trim();
      }
      
      let price = price_range.split('-');
      $("#slider-range").slider({
          range: true,
          min: min_value,
          max: max_value,
          values: price,
          slide: function (event, ui) {
              $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
              $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
          }
      });
  }
  if ($("#amount").length > 0) {
      const m_currency = $("#slider-range").data('currency') || '';
      $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
          "  -  "+m_currency + $("#slider-range").slider("values", 1));
  }
})
</script>
@endpush


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