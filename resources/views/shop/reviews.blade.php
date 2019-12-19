@foreach($reviews as $review)
<div class="review_item">
	<div class="media">
	  <div class="d-flex">
		@if($review->user)
            <img src="{{Helper::get_gravatar($review->user->email)}}" alt="{{$review->user->name}}">
        @else
            <img src="{{Helper::get_gravatar($review->email)}}" alt="{{ $review->name }}">
        @endif
	  </div>
	  <div class="media-body">
	    <h4>
	    	@if($review->user)
                <a href="#">{{ $review->user->name }}</a>
            @else
                <a href="{{$review->website}}" target="blank">{{ $review->name }}</a>
            @endif
        </h4>
	    <i class="fa fa-star"></i>
	    <i class="fa fa-star"></i>
	    <i class="fa fa-star"></i>
	    <i class="fa fa-star"></i>
	    <i class="fa fa-star"></i>
	  </div>
	</div>
	<p>
	  {{ $review->body}}
	</p>
</div>
@endforeach