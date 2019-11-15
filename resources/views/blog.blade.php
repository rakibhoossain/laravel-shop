@extends('layouts.app')
@section('content')

@if(count($posts)>0 )
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
<section class="blog_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                  @foreach($posts as $post)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="img/blog/main-blog/m-blog-3.jpg" alt="">
                            <a href="{{route('blog.single', $post->slug)}}" class="blog_item_date">
                                <h3>{{date_format($post->updated_at,"d")}}</h3>
                                <p>{{date_format($post->updated_at,"M")}}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{route('blog.single', $post->slug)}}">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <p>

                            excertp

                            {{$post->body}}

                            </p>
                            <ul class="blog-info-link">
                                <li><a href="{{route('blog.single', $post->slug)}}"><i class="ti-user"></i> Travel, Lifestyle</a></li>
                                <li><a href="{{route('blog.single', $post->slug)}}"><i class="ti-comments"></i> 03 Comments</a></li>
                            </ul>
                        </div>
                    </article>
                  @endforeach

                    <nav class="blog-pagination justify-content-center d-flex">
                        {{$posts->links()}}
                    </nav>

                </div>
            </div>
            <div class="col-lg-4">
                @include('layouts.sidebar')
            </div>

        </div>
    </div>
</section>
<!--================End Blog Area =================-->





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