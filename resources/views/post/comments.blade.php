@foreach($comments as $comment)

@php $dep = $depth-1; @endphp

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="comment-list">
            <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                    <div class="thumb">
                    @if($comment->user)
                        <img src="{{Helper::get_gravatar($comment->user->email)}}" alt="{{$comment->user->name}}">
                    @else
                        <img src="{{Helper::get_gravatar($comment->email)}}" alt="{{ $comment->name }}">
                    @endif
                    </div>
                    <div class="desc">
                        <p class="comment">
                            {{ $comment->body }}
                        </p>

                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5>
                                @if($comment->user)
                                    <a href="#">{{ $comment->user->name }}</a>
                                @else
                                    <a href="{{$comment->website}}" target="blank">{{ $comment->name }}</a>
                                @endif
                                </h5>
                                <p class="date">{{date_format($comment->created_at,"F D, Y")}} at {{date_format($comment->created_at,"g:i a")}}</p>

                            </div>
                            
                            @if($dep)
                            <div class="reply-btn">
                                <a href="#" class="btn-reply reply text-uppercase" data-id="{{ $comment->id }}">Reply</a>
                                <a href="#" class="btn-reply cancel text-uppercase" style="display: none;">Cancel</a>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('post.comments', ['comments' => $comment->replies, 'depth' => $dep])
    </div>
@endforeach