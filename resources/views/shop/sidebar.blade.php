        <div class="left_sidebar_area">
          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Browse Categories</h3>
            </div>
            <div class="widgets_inner">
              <!-- <ul class="list"> -->
              @if(!empty($_GET['category'])) @php $filter_cats = explode(',', $_GET['category']); @endphp @endif
                @foreach(Helper::productCategoryList() as $cat)
                <!-- <li>
                  <a href="{{route('shop.category', $cat->slug)}}">{{$cat->name}}</a>
                </li> -->
                <label><input type="checkbox" name="category[]" @if( !empty($filter_cats) && in_array($cat->slug, $filter_cats)) checked @endif onchange="this.form.submit();" value="{{$cat->slug}}"> {{$cat->name}}</label>
                @endforeach

              <!-- </ul> -->
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Product Brand</h3>
            </div>
            <div class="widgets_inner">
            @if(!empty($_GET['brand'])) @php $filter_brands = explode(',', $_GET['brand']); @endphp @endif
              <!-- <ul class="list"> -->
                @foreach(Helper::productBrandList() as $brand)
                <!-- <li>
                  <a href="{{route('shop.brand', $brand->slug)}}">{{$brand->name}}</a>
                </li> -->
                <label><input type="checkbox" name="brand[]" @if(!empty($filter_brands) && in_array($brand->slug, $filter_brands)) checked @endif onchange="this.form.submit();" value="{{$brand->slug}}"> {{$brand->name}}</label>
                @endforeach
              <!-- </ul> -->
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