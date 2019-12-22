        <div class="left_sidebar_area">
          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Browse Categories</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
              @if(!empty($_GET['category'])) @php $filter_cats = explode(',', $_GET['category']); @endphp @endif
                @foreach(Helper::productCategoryList('products') as $cat)
                <li>
                  <input type="checkbox" id={{$cat->slug}} name="category[]" @if( !empty($filter_cats) && in_array($cat->slug, $filter_cats)) checked @endif onchange="this.form.submit();" value="{{$cat->slug}}">
                  <label for={{$cat->slug}}>{{$cat->name}}({{ $cat->products->count() }})</label>
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
            @if(!empty($_GET['brand'])) @php $filter_brands = explode(',', $_GET['brand']); @endphp @endif
              <ul class="list">
                @foreach(Helper::productBrandList() as $brand)
                <li>
                  <input type="checkbox" id={{$brand->slug}} name="brand[]" @if(!empty($filter_brands) && in_array($brand->slug, $filter_brands)) checked @endif onchange="this.form.submit();" value="{{$brand->slug}}">
                  <label for={{$brand->slug}}>{{$brand->name}}({{ $brand->products->count() }})</label>
                </li>
                @endforeach
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Price Filter</h3>
            </div>
            <div class="widgets_inner">
              <div class="range_item">
                <div id="slider-range" data-min="{{Helper::currency_amount(Helper::minPrice())}}" data-max="{{Helper::currency_amount(Helper::maxPrice())}}" data-currency="{{Helper::currency()}}"></div>
                <div class="product_filter">
                  <button type="submit" class="btn filter_button">Filter</button>
                  <label for="amount">Price : </label>
                  <input type="text" id="amount" readonly/>
                  <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                </div>
              </div>
            </div>
          </aside>
        </div>