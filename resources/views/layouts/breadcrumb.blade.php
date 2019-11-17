<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>{{$title}}</h2>
          @if($description)
          <p>{{$description}}</p>
          @endif
        </div>
        <div class="page_link">
        	<a href="{{route('home')}}">Home</a>

		    @php $segments = ''; @endphp
		    @foreach(Request::segments() as $segment)
		        @php $segments .= '/'.$segment; @endphp
		        <a href="{{route('home')}}{{ $segments }}"> {{ ucwords(str_replace('-', ' ', $segment))  }}</a>
		    @endforeach

        </div>
      </div>
    </div>
  </div>
</section>