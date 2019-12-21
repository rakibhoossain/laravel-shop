<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
      <form action="{{ route('post.search') }}" method="GET">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search Keyword">
                <div class="input-group-append">
                    <button class="btn" type="button"><i class="ti-search"></i></button>
                </div>
            </div>
        </div>
        <button class="main_btn rounded-0 w-100" type="submit">Search</button>
      </form>
    </aside>

    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Category</h4>
        <ul class="list cat-list">
            @foreach(Helper::postCategoryList('posts') as $category)
            <li>
                <a href="{{ route('post.category', $category->slug) }}" class="d-flex">
                    <p>{{ $category->name }}</p>
                    <p>({{ $category->posts->count() }})</p>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>

    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Recent Post</h3>
        @foreach(Helper::recentPost() as $post)
            <div class="media post_item">
                @if($post->image)
                    <img src="{{asset('images/post/small/'.$post->image)}}" alt="{{$post->title}}">
                @endif
                <div class="media-body">
                    <a href="{{route('post.single', $post->slug)}}">
                        <h3>{{$post->title}}</h3>
                    </a>
                    <p>{{date_format($post->updated_at,"d M, Y")}}</p>
                </div>
            </div>
        @endforeach
    </aside>

    <aside class="single_sidebar_widget tag_cloud_widget">
        <h4 class="widget_title">Tag Clouds</h4>
        <ul class="list">
            @foreach(Helper::postTagList('posts') as $tag)
            <li>
                <a href="{{ route('post.tag', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
            @endforeach
        </ul>
    </aside>

    <aside class="single_sidebar_widget newsletter_widget">
        <h4 class="widget_title">Newsletter</h4>
        <form action="{{ route('shop.subscribe') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
            </div>
            <button class="main_btn rounded-0 w-100" type="submit">Subscribe</button>
        </form>
    </aside>
</div>