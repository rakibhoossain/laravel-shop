@foreach($comments as $comment)

@php $dep = $depth-1; @endphp
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="comment-list">


        <div class="review_item @if($comment->parent_id != null) reply @endif">
            <div class="media">
                <div class="d-flex">
                @if($comment->user)
                    <img src="{{Helper::get_gravatar($comment->user->email)}}" alt="{{$comment->user->name}}">
                @else
                    <img src="{{Helper::get_gravatar($comment->email)}}" alt="{{ $comment->name }}">
                @endif
                </div>
                <div class="media-body">
                    <h4>
                    @if($comment->user)
                        <a href="#">{{ $comment->user->name }}</a>
                    @else
                        <a href="{{$comment->website}}" target="blank">{{ $comment->name }}</a>
                    @endif
                    </h4>
                    <h5>{{date_format($comment->created_at,"F D, Y")}} at {{date_format($comment->created_at,"g:i a")}}</h5>
                    @if($dep)
                    <div class="reply-btn">
                        <a href="#" class="btn-reply reply reply_btn text-uppercase" data-id="{{ $comment->id }}">Reply</a>
                        <a href="#" class="btn-reply cancel reply_btn text-uppercase" style="display: none;">Cancel</a>
                    </div>
                    @endif
                </div>
            </div>
            <p>{{ $comment->body}}</p>
        </div>
        
        </div>
        @include('shop.comments', ['comments' => $comment->replies, 'depth' => $dep])
    </div>
@endforeach