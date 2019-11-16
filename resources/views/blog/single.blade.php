@extends('layouts.app')
@section('content')

@if($post)
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Blog</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="category.html">Blog</a>
          <a href="category.html">Women Fashion</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->


    <!--================Blog Area =================-->
  <section class="blog_area single-post-area section_gap">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 posts-list">
                  <div class="single-post">
                          <div class="feature-img">
                              <img class="img-fluid" src="{{asset('images/post/'.$post->image)}}" alt="{{$post->title}}" />
                          </div>
                      <div class="blog_details">
                          <h2>{{$post->title}}</h2>
                          <ul class="blog-info-link mt-3 mb-4">
                              <li><a href="#"><i class="ti-user"></i> Travel, Lifestyle</a></li>
                              <li><a href="#"><i class="ti-comments"></i> 03 Comments</a></li>

                              <li>
                                <i class="ti-comments"></i>
                                @foreach($post->terms as $term)
                                  <a href="#">{{ $term->category->name }}</a>
                                @endforeach
                              </li>

                            </ul>
                            {!! html_entity_decode($post->body) !!}
                      </div>
                  </div>
                  <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                      <p class="like-info"><span class="align-middle"><i class="ti-heart"></i></span> Lily and 4 people like this</p>
                      <div class="col-sm-4 text-center my-2 my-sm-0">
                        <p class="comment-count"><span class="align-middle"><i class="ti-comment"></i></span> 06 Comments</p>
                      </div>
                      <ul class="social-icons">
                        <li><a href="#"><i class="ti-facebook"></i></a></li>
                        <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li><a href="#"><i class="ti-dribbble"></i></a></li>
                        <li><a href="#"><i class="ti-wordpress"></i></a></li>
                      </ul>
                    </div>

                    <div class="navigation-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('img/blog/prev.jpg')}}" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="ti-arrow-left text-white"></span>
                                    </a>
                                </div>
                                <div class="detials">
                                    <p>Prev Post</p>
                                    <a href="#">
                                        <h4>Space The Final Frontier</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Post</p>
                                    <a href="#">
                                        <h4>Telescopes 101</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="ti-arrow-right text-white"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('img/blog/next.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                  
                  <div class="blog-author">
                    <div class="media align-items-center">
                      <img src="{{asset('img/blog/author.png')}}" alt="">
                      <div class="media-body">
                        <a href="#">
                          <h4>Harvard milan</h4>
                        </a>
                        <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he our dominion twon Second divided from</p>
                      </div>
                    </div>
                  </div>

                  <div class="comments-area">
                      <h4>05 Comments</h4>
                      <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="{{asset('img/blog/c1.png')}}" alt="">
                              </div>
                              <div class="desc">
                                  <p class="comment">
                                    Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser 
                                  </p>

                                  <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                      <h5>
                                        <a href="#">Emilly Blunt</a>
                                      </h5>
                                      <p class="date">December 4, 2017 at 3:12 pm </p>
                                    </div>

                                    <div class="reply-btn">
                                      <a href="#" class="btn-reply text-uppercase">reply</a>
                                    </div>
                                  </div>
                                  
                              </div>
                          </div>
                      </div>
                      </div>
                      <div class="comment-list">
                          <div class="single-comment justify-content-between d-flex">
                              <div class="user justify-content-between d-flex">
                                  <div class="thumb">
                                      <img src="{{asset('img/blog/c2.png')}}" alt="">
                                  </div>
                                  <div class="desc">
                                      <p class="comment">
                                        Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser 
                                      </p>
    
                                      <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                          <h5>
                                            <a href="#">Emilly Blunt</a>
                                          </h5>
                                          <p class="date">December 4, 2017 at 3:12 pm </p>
                                        </div>
    
                                        <div class="reply-btn">
                                          <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                      </div>
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="comment-list">
                          <div class="single-comment justify-content-between d-flex">
                              <div class="user justify-content-between d-flex">
                                  <div class="thumb">
                                      <img src="{{asset('img/blog/c3.png')}}" alt="">
                                  </div>
                                  <div class="desc">
                                      <p class="comment">
                                        Multiply sea night grass fourth day sea lesser rule open subdue female fill which them Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser 
                                      </p>
    
                                      <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                          <h5>
                                            <a href="#">Emilly Blunt</a>
                                          </h5>
                                          <p class="date">December 4, 2017 at 3:12 pm </p>
                                        </div>
    
                                        <div class="reply-btn">
                                          <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                      </div>
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="comment-form">
                      <h4>Leave a Reply</h4>
                      <form class="form-contact comment_form" action="#" id="commentForm">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="main_btn">Send Message</button>
                        </div>
                      </form>
                  </div>
              </div>
              <div class="col-lg-4">
                @include('layouts.sidebar')
              </div>
          </div>
      </div>
  </section>
  <!--================Blog Area =================-->




@else
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>No post found</h2>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@endsection