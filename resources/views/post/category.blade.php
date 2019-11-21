@extends('layouts.app')
@section('content')

@if($category)
<!--================Home Banner Area =================-->
@include('layouts.breadcrumb', ['title' => 'Category: '.$category->name, 'description' => 'Description'])
<!--================End Home Banner Area =================-->



<!--================Blog Area =================-->
<section class="blog_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                  @foreach($category->terms as $cat)


                  {{var_dump($cat)}}
 {{--                    <article class="blog_item">
                        <div class="blog_item_img">
                            @if($cat->post->image)
                              <img class="card-img rounded-0" src="{{asset('images/post/'.$cat->post->image)}}" alt="{{$cat->post->title}}">
                            @endif
                            <a href="{{route('post.single', $cat->post->slug)}}" class="blog_item_date">
                                <h3>{{date_format($cat->post->updated_at,"d")}}</h3>
                                <p>{{date_format($cat->post->updated_at,"M")}}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                          <a class="d-inline-block" href="{{route('post.single', $cat->post->slug)}}"><h2>{{$cat->post->title}}</h2></a>
                          <p>
                            {{Str::words(strip_tags($post->body),16)}}
                          </p>
                          <ul class="blog-info-link">
                              <li><a href="{{route('post.single', $cat->post->slug)}}"><i class="ti-user"></i> {{$cat->post->user->name}}</a></li>
                              <li><a href="{{route('post.single', $cat->post->slug)}}#comments-area"><i class="ti-comments"></i> {{count($cat->post->allComments)}} Comments</a></li>
                          </ul>
                        </div>
                    </article> --}}
                  @endforeach

                    <nav class="blog-pagination justify-content-center d-flex">
                        {{-- {{$posts->links()}} --}}
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