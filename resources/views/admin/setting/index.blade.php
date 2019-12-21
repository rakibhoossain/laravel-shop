@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Settings</h5>
  <div class="card-body">





  <div class="row">
    <div class="col-md-2 mb-3">
      <ul class="nav nav-pills flex-column" id="settingsTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="shop-tab" data-toggle="tab" href="#shop" role="tab" aria-controls="shop" aria-selected="false">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="blog-tab" data-toggle="tab" href="#blog" role="tab" aria-controls="blog" aria-selected="false">Blog</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">Social</a>
        </li>
      </ul>
    </div>

    <div class="col-md-10">
      <div class="tab-content" id="settingsTabContent">
        
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
          <form method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-row">
              <div class="form-group col-md-4">
                <div class="custom-file mb-3">
                  <input type="file" class="custom-file-input" name="siteLogo" id="siteLogo">
                  <label class="custom-file-label" for="siteLogo">Logo</label>
                </div>
              </div>
              <div class="form-group col-md-4"><img src="https://via.placeholder.com/137x38.png?text=Logo"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <div class="custom-file mb-3">
                  <input type="file" class="custom-file-input" name="siteFavIcon" id="siteFavIcon">
                  <label class="custom-file-label" for="siteFavIcon">Site icon</label>
                </div>
              </div>
              <div class="form-group col-md-4"><img src="https://via.placeholder.com/45x45.png?text=Icon"></div>
            </div>
            <div class="form-group">
              <label for="siteTitle" class="col-form-label">Site Title</label>
              <input id="siteTitle" type="text" name="siteTitle" class="form-control">
            </div>
            <div class="form-group">
              <label for="siteDescription" class="col-form-label">Site Description</label>
              <textarea class="form-control" name="siteDescription" id="siteDescription" rows="3"></textarea>
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
              <label for="siteEmail" class="col-form-label">Site Email</label>
              <input id="siteEmail" type="text" name="siteEmail" class="form-control">
            </div>
            <div class="form-group">
              <label for="sitePhone" class="col-form-label">Site Phone</label>
              <input id="sitePhone" type="text" name="sitePhone" class="form-control">
            </div>
            <div class="form-group">
              <label for="siteCopyright" class="col-form-label">Copyright text</label>
              <input id="siteCopyright" type="text" name="siteCopyright" class="form-control">
            </div>
            <div class="form-group mb-3">
              <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="shop" role="tabpanel" aria-labelledby="shop-tab">
          <form method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label for="shopCurrency" class="col-form-label">Default currency</label>
              <select class="form-control" name="shopCurrency" id="shopCurrency">
                <option value="">Select currency</option>
                @foreach(Helper::currencies() as $currency)
                  <option value="{{$currency->id}}">{{$currency->code}} {{$currency->symbol}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3">
              <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
          </form>

          <ul class="nav nav-tabs" id="shopTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="ship-tab" data-toggle="tab" href="#ship" role="tab" aria-controls="ship" aria-selected="true">Shipping</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="currency-tab" data-toggle="tab" href="#currency" role="tab" aria-controls="currency" aria-selected="false">Currency</a>
            </li>
          </ul>
          <div class="tab-content" id="shopTabContent">

            <div class="tab-pane fade show active" id="ship" role="tabpanel" aria-labelledby="ship-tab">
              <h4 class="text-center">Shipping list <a href="#">Add</a></h4>
              @if(count(Helper::shiping())>0)
              <table class="table table-striped table-hover admin-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Rate</th>

                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach(Helper::shiping() as $shiping)
                  <tr>
                    <td scope="row">{{$loop->index +1 }}</td>
                    <td>{{$shiping->type}}</td>
                    <td>{{$shiping->price}}</td>
                    <td>
                      <a class="btn btn-primary" href="#">Edit</a>
                      <a class="btn btn-danger" href="#">Delete</a>
                    </td>


                  </tr>
                  @endforeach

                </tbody>
              </table>
              @else
                <hr class="sidebar-divider">
                <h2>Empty.</h2>
              @endif
            </div>
            <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="currency-tab">...</div>
          </div>
        </div>

        <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="blog-tab">
        <h2>Blog settings</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
        </div>

        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
          <form method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label for="siteFacebook" class="col-form-label">Facebook url</label>
              <input id="siteFacebook" type="text" name="siteFacebook" class="form-control">
            </div>
            <div class="form-group">
              <label for="siteTwitter" class="col-form-label">Twitter url</label>
              <input id="siteTwitter" type="text" name="siteTwitter" class="form-control">
            </div>
            <hr class="sidebar-divider">
            <div class="form-group mb-3">
              <button type="reset" class="btn btn-warning">Reset</button> <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>



















  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {

  });
</script>
@endpush