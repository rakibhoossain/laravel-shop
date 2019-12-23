@extends('layouts.app')
@section('content')

  @if($product)

    @section('title')
      {{$product->title}}
    @endsection
    <!--================Home Banner Area =================-->
    @include('layouts.breadcrumb', ['title' => $product->title, 'description' => 'Description'])
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner">
          <div class="col-lg-6">
            <div class="s_product_img">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                
                <ol class="carousel-indicators">
                @foreach($product->images as $image)
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" @if($loop->index == 0) class="active" @endif>
                    <img src="{{asset('images/product/small/'.$image->image)}}" alt="{{$product->title}}" width="60" height="60" />
                  </li>
                @endforeach
                </ol>

                <div class="carousel-inner">
                  @foreach($product->images as $image)
                  <div class="carousel-item @if($loop->index == 0) active @endif">
                    <img
                      class="d-block w-100"
                      src="{{asset('images/product/'.$image->image)}}"
                      alt="{{$product->title}}"
                    />
                  </div>
                  @endforeach
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
              <h3>{{$product->title}}</h3>
              <h2>{{Helper::currency()}}{{Helper::currency_amount($product->price)}}</h2>
              <ul class="list">
                @if($product->category)
                  <li><a class="active" href="{{route('shop.category', $product->category->slug)}}"><span>Category</span> : {{$product->category->name}}</a></li>
                @endif
                @if($product->brand)
                  <li><a class="active" href="{{route('shop.brand', $product->brand->slug)}}"><span>Brand</span> : {{$product->brand->name}}</a></li>
                @endif
                <li>
                  <a href="{{route('shop.single', $product->slug)}}"> <span>Availibility</span> : {{$product->quantity}} In Stock</a>
                </li>
              </ul>
               <p>
                 {{Str::words(strip_tags($product->description),16)}}
               </p>

              <form method="post" action="{{ route('cart.singleToAdd') }}" class="mt-10">
                {{csrf_field()}}
                <div class="product_count">
                  <label for="qty">Quantity:</label>
                  <input type="text" name="qty" id="sst" maxlength="12" value="1" class="input-text qty"/>
                  <input type="hidden" name="slug" value="{{$product->slug}}" />

                  <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                    <i class="lnr lnr-chevron-up"></i>
                  </button>
                  <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button" >
                    <i class="lnr lnr-chevron-down"></i>
                  </button>
                </div>

                <div class="card_area">
                  <button type="submit" name="add_to_cart" class="main_btn">Add to Cart</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Description</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="profile-tab"
              data-toggle="tab"
              href="#profile"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
              >Specification</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >Comments</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link active"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Reviews</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade"id="home" role="tabpanel" aria-labelledby="home-tab">
            {!! html_entity_decode($product->description) !!}
          </div>

          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <h5>Width</h5>
                    </td>
                    <td>
                      <h5>128mm</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Height</h5>
                    </td>
                    <td>
                      <h5>508mm</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Depth</h5>
                    </td>
                    <td>
                      <h5>85mm</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Weight</h5>
                    </td>
                    <td>
                      <h5>52gm</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Quality checking</h5>
                    </td>
                    <td>
                      <h5>yes</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Freshness Duration</h5>
                    </td>
                    <td>
                      <h5>03days</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>When packeting</h5>
                    </td>
                    <td>
                      <h5>Without touch of hand</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Each Box contains</h5>
                    </td>
                    <td>
                      <h5>60pcs</h5>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                @include('shop.comments', ['comments' => $product->comments, 'depth' => 2])
              </div>

              <div class="col-lg-6">
                <div class="review_box" id="commentFormContainer">
                  <h4>Post a comment</h4>


                    <form  method="post" class="row contact_form" action="{{ route('product.comments.store'   ) }}" id="commentForm">
                        {{csrf_field()}}

                      @guest
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="comments_name" name="name" placeholder="Your Full name" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="email" class="form-control" id="comments_email" name="email" placeholder="Email Address" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="comments_number" name="phone" placeholder="Phone Number" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="comments_website" name="website" placeholder="Website" />
                          </div>
                      </div>
                      @endguest
                      <div class="col-md-12">
                          <div class="form-group">
                              <textarea class="form-control" name="body" id="comments_message" rows="3" placeholder="Message"></textarea>
                              <input type="hidden" name="product_id" value="{{ $product->id }}" />
                              <input type="hidden" name="parent_id" id="parent_id" value="" />
                          </div>
                      </div>
                      <div class="col-md-12 text-right">
                          <button type="submit" value="submit" class="btn submit_btn">
                              Submit Now
                          </button>
                      </div>

                    </form>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade show active"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>Overall</h5>
                      <h4>{{Helper::reviewOveralStar($product->id)}}</h4>
                      <h6>(0{{Helper::reviewOveralStar($product->id, 'count')}} Reviews)</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>Based on {{Helper::reviewOveralStar($product->id, 'count')}} Reviews</h3>
                      <ul class="list">
                        <li>
                          <a href="#"
                            >5 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> {{Helper::reviewStar($product->id, 5)}}</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >4 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i> {{Helper::reviewStar($product->id, 4)}}</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >3 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i> {{Helper::reviewStar($product->id, 3)}}</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >2 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i> {{Helper::reviewStar($product->id, 2)}}</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >1 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i> {{Helper::reviewStar($product->id, 1)}}</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="review_list">
                  @include('shop.reviews', ['reviews' => $product->reviews])


                </div>
              </div>
              <div class="col-lg-6">
    <div class="review_box">
        <h4>Add a Review</h4>
        <!-- <p>Your Rating:</p> -->
<!--         <ul class="list">
            <li>
              <i class="fa fa-star-o" title="5" data-value="5"></i>
            </li>
            <li>
              <i class="fa fa-star-o" title="4" data-value="4"></i>
            </li>
            <li>
              <i class="fa fa-star-o" title="3" data-value="3"></i>
            </li>
            <li>
              <i class="fa fa-star-o" title="2" data-value="2"></i>
            </li>
            <li>
              <i class="fa fa-star-o" title="1" data-value="1"></i>
            </li>
        </ul> -->



        <!-- <p>Outstanding</p> -->


                   <form  method="post" class="row contact_form" action="{{ route('product.review.store'   ) }}" id="reviewForm">
                        {{csrf_field()}}
<div class="col-md-12">
  <div class="rating_box">
   <p>Your Rating:</p>                     
    <div class="star-rating">
      <div class="star-rating__wrap">
        <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
        <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
        <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
        <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
        <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
        <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
      </div>
    </div>
 <p>Outstanding</p>
</div>
</div>


                      @guest
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="review_name" name="review_name" placeholder="Your Full name" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="email" class="form-control" id="review_email" name="review_email" placeholder="Email Address" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="review_website" name="review_website" placeholder="Website" />
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" id="review_number" name="review_phone" placeholder="Phone Number" />
                          </div>
                      </div>
                      @endguest
                      <div class="col-md-12">
                          <div class="form-group">
                              <textarea class="form-control" name="review_body" id="review_message" rows="3" placeholder="Message"></textarea>
                              <input type="hidden" name="review_product_id" value="{{ $product->id }}" />
                          </div>
                      </div>
                      <div class="col-md-12 text-right">
                          <button type="submit" value="submit" class="btn submit_btn">
                              Submit Now
                          </button>
                      </div>

                    </form>

















    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->

    @push('scripts')
    <script src="{{ asset('js/comment.js') }}"></script>
    @endpush

  @else
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>No product found!</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

@endsection