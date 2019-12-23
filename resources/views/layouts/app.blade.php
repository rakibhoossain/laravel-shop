<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title','Laravel') - {{setting('app_name')}}</title>
  @if( Helper::setting()->has('icon') && !empty(setting('icon')) )
    <link rel="icon" type="image/png" href="{{Storage::disk('public')->url(setting('icon'))}}" sizes="45x45">
  @endif
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/nice-select/css/nice-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}" />
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
  <script>
      window.baseURL = '{{url('/')}}';
  </script>
</head>

<body>
  <!--================Header Menu Area =================-->
  @include('admin.partials.alert')
<div id="app">
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>@if( Helper::setting()->has('app_email') && !empty(setting('app_email')) ) PHONE: <a href="mailto:{{setting('app_email')}}">{{setting('app_email')}}</a>@endif</p>
              <p>@if( Helper::setting()->has('app_phone') && !empty(setting('app_phone')) )<a href="tel:{{setting('app_phone')}}">{{setting('app_phone')}}</a>@endif</p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="float-right">
              <ul class="right_side">
                <li>
                  <a href="{{route('shop.track')}}">
                    track order
                  </a>
                </li>
                <li>
                  <a href="{{route('contact')}}">
                    Contact Us
                  </a>
                </li>
                @if( Helper::setting()->has('shop_currency'))

                <li class="curreny-wrap">Currency <i class="fa fa-angle-down"></i>
                    <ul class="curreny-list">
                      <li @if(Helper::base_currency() == Helper::currency()) class="active" @endif ><a href="{{route('shop.currency', 0)}}">{{Helper::base_currency_data()['symbol']}} {{Helper::base_currency_data()['code']}}</a></li>
                      @foreach(Helper::currencies() as $currency)
                        <li @if($currency->symbol == Helper::currency()) class="active" @endif ><a href="{{route('shop.currency', $currency->id)}}">{{$currency->symbol}} {{$currency->code}}</a></li>
                      @endforeach
                    </ul>
                </li>
                @endif
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
            @if( Helper::setting()->has('logo') && !empty(setting('logo')) )
            <img src="{{Storage::disk('public')->url(setting('logo'))}}" alt="" />
            @endif
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
                <li class="nav-item {{Request::path() === '/' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>

                @auth @if(Auth::user()->is_admin)
                <li class="nav-item {{Request::path() === 'admin' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin')}}">Admin</a>
                </li>
                @endif @endauth

                @auth
                <li class="nav-item {{Request::path() === 'account' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('account')}}">Account</a>
                </li>
                @endauth

                <li class="nav-item {{Request::path() === 'shop' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('shop')}}">Shop</a>
                </li>

                <li class="nav-item {{Request::path() === 'post' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('post')}}">Blog</a>
                </li>

                <li class="nav-item {{Request::path() === 'contact' ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('contact')}}">Contact</a>
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
@yield('content')

<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
    @foreach(Helper::get_widget('footer') as $footer)
      {!!$footer->content!!}
    @endforeach
    </div>
    <div class="footer-bottom row align-items-center">
      <p class="footer-text m-0 col-lg-8 col-md-12">@if( Helper::setting()->has('copyright_text') && !empty(setting('copyright_text')) ) {{setting('copyright_text')}} | @endif Developed by <a href="https://github.com/rakibhoossain" target="_blank">Rakib Hossain</a></p>
      <div class="col-lg-4 col-md-12 footer-social">
        @if( Helper::setting()->has('social_facebook') && !empty(setting('social_facebook')) )<a href="{{setting('social_facebook')}}" target="_blank"><i class="fa fa-facebook"></i></a>@endif
        @if(Helper::setting()->has('social_twitter') && !empty(setting('social_twitter')) )<a href="{{setting('social_twitter')}}" target="_blank"><i class="fa fa-twitter"></i></a>@endif
        @if(Helper::setting()->has('social_dribbble') && !empty(setting('social_dribbble')) )<a href="{{setting('social_dribbble')}}" target="_blank"><i class="fa fa-dribbble"></i></a>@endif
        @if(Helper::setting()->has('social_behance') && !empty(setting('social_behance')) )<a href="{{setting('social_behance')}}" target="_blank"><i class="fa fa-behance"></i></a>@endif
        @if(Helper::setting()->has('social_linkedin') && !empty(setting('social_linkedin')) )<a href="{{setting('social_linkedin')}}" target="_blank"><i class="fa fa-linkedin"></i></a>@endif
      </div>
    </div>
  </div>
</footer>
<!--================ End footer Area  =================-->
</div> <!--End app -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/jquery-ui/jquery-ui.js') }}"></script> -->
<script src="{{ asset('js/theme.js') }}"></script>
<!-- Page level custom scripts -->
@stack('scripts')

<script type="text/javascript">
  window.Echo.channel('message').notification((notification) => {console.log(notification)});


                    // .listen('contactMessage', (e) => {
                    //     console.log(e)
                    // })
</script>

</body>
</html>