<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title','Ecommerce Laravel')</title>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">





  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}" /> --}}
  <link rel="stylesheet" href="{{ asset('vendors/lightbox/simpleLightbox.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/nice-select/css/nice-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}" />
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
</head>

<body>
  <!--================Header Menu Area =================-->
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
<div id="app">
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>Phone: +01 256 25 235</p>
              <p>email: info@eiser.com</p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="float-right">
              <ul class="right_side">
                <li>
                  <a href="cart.html">
                    gift card
                  </a>
                </li>
                <li>
                  <a href="{{route('shop.track')}}">
                    track order
                  </a>
                </li>
                <li>
                  <a href="contact.html">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="{{route('home')}}">
            <img src="{{asset('img/logo.png')}}" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
          <div class="row w-100 mr-0">
            <div class="col-lg-7 pr-0">
              <ul class="nav navbar-nav center_nav pull-right">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>

                @auth @if(Auth::user()->is_admin)
                <li class="nav-item">
                  <a class="nav-link" href="{{route('admin')}}">Admin</a>
                </li>
                @endif @endauth

                @auth
                <li class="nav-item">
                  <a class="nav-link" href="{{route('account')}}">Account</a>
                </li>
                @endauth

                <li class="nav-item">
                  <a class="nav-link" href="{{route('shop')}}">Shop</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="{{route('blog')}}">Blog</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
                </li>

              </ul>

            </div>

            <div class="col-lg-5 pr-0">
              <ul class="nav navbar-nav navbar-right right_nav pull-right">


                <li class="nav-item submenu dropdown">
                  <a id="navSearchDropdown" class="nav-link dropdown-toggle icons" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                   <i class="ti-search" aria-hidden="true"></i>
                 </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navSearchDropdown" style="padding:0;width: 250px;">
                  <form action="{{ route('shop.search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search...." aria-label="Search" name="search">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <li class="nav-item">
                @if(Helper::cartCount()>0)
                <a href="{{route('cart')}}" class="icons cart-icon">
                  <span class="fa fa-stack fa-1x has-badge" data-count="{{Helper::cartCount()}}">
                    <i class="fa ti-shopping-cart"></i>
                  </span>
                </a>
                @else
                <a href="{{route('cart')}}" class="icons"><i class="fa ti-shopping-cart"></i></a>
                @endif
              </li>

              <li class="nav-item">
                <a href="#" class="icons">
                  <i class="ti-heart" aria-hidden="true"></i>
                </a>
              </li>

              <li class="nav-item submenu dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle icons" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 <i class="ti-user" aria-hidden="true"></i>
               </a>

               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <!-- Authentication Links -->
                @guest
                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                @else
                <a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endguest
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>
</div>
</div>
</header>
<!--================Header Menu Area =================-->



<div class="section-block">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
  @endif

  @if (count($errors) > 0)
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
</div>








@yield('content')

<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Top Products</h4>
        <ul>
          <li><a href="#">Managed Website</a></li>
          <li><a href="#">Manage Reputation</a></li>
          <li><a href="#">Power Tools</a></li>
          <li><a href="#">Marketing Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Jobs</a></li>
          <li><a href="#">Brand Assets</a></li>
          <li><a href="#">Investor Relations</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Features</h4>
        <ul>
          <li><a href="#">Jobs</a></li>
          <li><a href="#">Brand Assets</a></li>
          <li><a href="#">Investor Relations</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Resources</h4>
        <ul>
          <li><a href="#">Guides</a></li>
          <li><a href="#">Research</a></li>
          <li><a href="#">Experts</a></li>
          <li><a href="#">Agencies</a></li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-6 single-footer-widget">
        <h4>Newsletter</h4>
        <p>You can trust us. we only send promo offers,</p>
        <div class="form-wrap" id="mc_embed_signup">
          <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
          method="get" class="form-inline">
          <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''"
          onblur="this.placeholder = 'Your Email Address '" required="" type="email">
          <button class="click-btn btn btn-default">Subscribe</button>
          <div style="position: absolute; left: -5000px;">
            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
          </div>

          <div class="info"></div>
        </form>
      </div>
    </div>
  </div>
  <div class="footer-bottom row align-items-center">
    <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      <div class="col-lg-4 col-md-12 footer-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-behance"></i></a>
      </div>
    </div>
  </div>
</footer>
<!--================ End footer Area  =================-->
</div> <!--End app -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/stellar.js') }}"></script>
<script src="{{ asset('vendors/lightbox/simpleLightbox.min.js') }}"></script> --}}
<script src="{{ asset('vendors/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
{{-- <script src="{{ asset('vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('vendors/isotope/isotope-min.js') }}"></script>
<script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('vendors/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/counter-up/jquery.counterup.js') }}"></script>
<script src="{{ asset('js/mail-script.js') }}"></script> --}}
<script src="{{ asset('js/theme.js') }}"></script>


<script type="text/javascript">
  $('.btn-reply.reply').click(function(e){
    e.preventDefault();
    $('.btn-reply.reply').show();

    $('.comment_btn.comment').hide();
    $('.comment_btn.reply').show();

    $(this).hide();
    $('.btn-reply.cancel').hide();
    $(this).siblings('.btn-reply.cancel').show();
    // $(this).parent('.reply-btn').append('<a href="#" class="btn-reply-cancel text-uppercase" >cancel</a>');


    console.log( $(this).data('id') );

    var parent_id = $(this).data('id');

var html = $('#commentForm');
    $( html).find('#parent_id').val(parent_id);
    $('#commentFormContainer').hide();
    $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');


console.log( $(this).parents('.comment-list')  );

  });  


$('.comment-list').on('click','.btn-reply.cancel',function(e){
    e.preventDefault();
    $(this).hide();
    $('.btn-reply.reply').show();

    
    $('.comment_btn.reply').hide();
    $('.comment_btn.comment').show();

    $('#commentFormContainer').show();
    var html = $('#commentForm');
    $( html).find('#parent_id').val('');

    $('#commentFormContainer').append(html);

    // alert("You clicked the element with and ID of 'test-element'");
});


</script>


</body>

</html>