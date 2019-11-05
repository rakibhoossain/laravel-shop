        <div class="left_sidebar_area">

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Browse Categories</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">

                @foreach(Helper::productCategoryList() as $cat)
                <li>
                  <a href="{{route('shop.category', $cat->slug)}}">{{$cat->name}}</a>
                </li>
                @endforeach

              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Product Brand</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                @foreach(Helper::productBrandList() as $cat)
                <li>
                  <a href="{{route('shop.brand', $cat->slug)}}">{{$cat->name}}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Color Filter</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                <li>
                  <a href="#">Black</a>
                </li>
                <li>
                  <a href="#">Black Leather</a>
                </li>
                <li class="active">
                  <a href="#">Black with red</a>
                </li>
                <li>
                  <a href="#">Gold</a>
                </li>
                <li>
                  <a href="#">Spacegrey</a>
                </li>
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Price Filter</h3>
            </div>
            <div class="widgets_inner">
              <div class="range_item">
                <div id="slider-range"></div>
                <div class="">
                  <label for="amount">Price : </label>
                  <input type="text" id="amount" readonly />
                </div>
              </div>
            </div>
          </aside>
        </div>