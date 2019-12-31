<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Laravel - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">


  <!-- This makes the current user's id available in javascript -->
  @if(!auth()->guest())
      <script>
          window.userId = '{{auth()->user()->id}}';
          window.baseURL = '{{url('/')}}';
      </script>
  @endif

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fas fa-laugh-wink"></i>
          <span>Home</span>
        </a>
      </li>



        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">Shop</div>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.product.order')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Order</span>
          </a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
            <i class="fas fa-fw fa-table"></i>
            <span>Product</span>
          </a>
          <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Product Options:</h6>
              <a class="collapse-item" href="{{route('admin.product')}}">Products</a>
              <a class="collapse-item" href="{{route('admin.product.create')}}">Add product</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-table"></i>
            <span>Category</span>
          </a>
          <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Category Options:</h6>
              <a class="collapse-item" href="{{route('admin.product.category')}}">Categories</a>
              <a class="collapse-item" href="{{route('admin.product.category.create')}}">Add category</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBrand" aria-expanded="true" aria-controls="collapseBrand">
            <i class="fas fa-fw fa-table"></i>
            <span>Brands</span>
          </a>
          <div id="collapseBrand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Brand Options:</h6>
              <a class="collapse-item" href="{{route('admin.product.brand')}}">Brands</a>
              <a class="collapse-item" href="{{route('admin.product.brand.create')}}">Add brand</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCurrency" aria-expanded="true" aria-controls="collapseCurrency">
            <i class="fas fa-fw fa-table"></i>
            <span>Currency</span>
          </a>
          <div id="collapseCurrency" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Currency Options:</h6>
              <a class="collapse-item" href="{{route('admin.currency')}}">Currency</a>
              <a class="collapse-item" href="{{route('admin.currency.create')}}">Add currency</a>
            </div>
          </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShipping" aria-expanded="true" aria-controls="collapseShipping">
            <i class="fas fa-fw fa-table"></i>
            <span>Shipping</span>
          </a>
          <div id="collapseShipping" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Shipping Options:</h6>
              <a class="collapse-item" href="{{route('admin.shipping')}}">Shipping</a>
              <a class="collapse-item" href="{{route('admin.shipping.create')}}">Add shipping</a>
            </div>
          </div>
        </li>





        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.product.comments')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Comments</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.product.reviews')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Reviews</span>
          </a>
        </li>






        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">Posts</div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
            <i class="fas fa-fw fa-table"></i>
            <span>Posts</span>
          </a>
          <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Product Options:</h6>
              <a class="collapse-item" href="{{route('admin.post')}}">Posts</a>
              <a class="collapse-item" href="{{route('admin.post.create')}}">Add posts</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePostCategory" aria-expanded="true" aria-controls="collapsePostCategory">
            <i class="fas fa-fw fa-table"></i>
            <span>Categories</span>
          </a>
          <div id="collapsePostCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Category Options:</h6>
              <a class="collapse-item" href="{{route('admin.post.category')}}">Categories</a>
              <a class="collapse-item" href="{{route('admin.post.category.create')}}">Add category</a>
            </div>
          </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTag" aria-expanded="true" aria-controls="collapseTag">
            <i class="fas fa-fw fa-table"></i>
            <span>Tags</span>
          </a>
          <div id="collapseTag" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Tags Options:</h6>
              <a class="collapse-item" href="{{route('admin.post.tag')}}">Tags</a>
              <a class="collapse-item" href="{{route('admin.post.tag.create')}}">Add tag</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.comments')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Comments</span>
          </a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWidgets" aria-expanded="true" aria-controls="collapseWidgets">
            <i class="fas fa-fw fa-table"></i>
            <span>Widgets</span>
          </a>
          <div id="collapseWidgets" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Widget Options:</h6>
              <a class="collapse-item" href="{{route('admin.widget')}}">Widgets</a>
              <a class="collapse-item" href="{{route('admin.widget.create')}}">Add widget</a>
            </div>
          </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">Sliders</div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSlider" aria-expanded="true" aria-controls="collapseSlider">
            <i class="fas fa-fw fa-table"></i>
            <span>Slider</span>
          </a>
          <div id="collapseSlider" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Slider Options:</h6>
              <a class="collapse-item" href="{{route('admin.slider')}}">Slider</a>
              <a class="collapse-item" href="{{route('admin.slider.create')}}">Add slider item</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.user')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}/settings">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span></a>
        </li>



          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

        </ul>
        <!-- End of Sidebar -->











        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

              <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>

              <!-- Topbar Search -->
<!--               <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form> -->

              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                  <!-- Dropdown - Messages -->
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                  @include('admin.partials.notification')
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1" id="messageT" data-url="{{route('messages.five')}}">
                   @include('admin.partials.message')
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">@auth {{ Auth::user()->name }} @endauth</span>
                    <img class="img-profile rounded-circle" src="@auth {{ Helper::get_gravatar(Auth::user()->email) }} @endauth">
                  </a>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('admin.user.show', Auth::user()->id)}}">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
                </li>

              </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
              <!-- Page Heading -->
{{--               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
              </div> --}} 
              @include('admin.partials.alert')         
              @yield('content')

            </div>
            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; <a href="https://github.com/rakibhoossain" target="_blank">Rakib Hossain</a> 2019</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                 @csrf
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Core plugin JavaScript-->
      <script src="{{ asset('js/dashboard.js') }}"></script>
      <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>

      <!-- Datatables-->
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

      <!-- Tinymce-->
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

      <!-- Custom scripts for all pages-->

      <script type="text/javascript">
        $(document).ready(function() {

          tinymce.init({ selector:'textarea.rich-editor', height: 300});

          $("#add_image_field").click(function(){ 
            const html = $(".clone_image").html();
            $("#imageuUpload").after(html);
          });

          $("body").on("click",".remove_image_field",function(){ 
            $(this).parents(".control-group").remove();
          });

          $("body").on("click","#image_preview .delete_image",function(){ 
            const id = $(this).data('id');
            const html = '<input type="hidden" class="d-none" name="imageID[]" value="'+id+'">';
            $("#imageuUpload").after(html);
            $(this).parent('.image-p').remove();

          });



          $('.chosen-select').chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
          });
          $('.chosen-select-deselect').chosen({ allow_single_deselect: true });

          if (userId) {
          Echo.private(`App.User.${userId}`)
            .notification((notification) => {

            const container = $('#notification-items');
            const counter_area = $('#notifications .count');
            
            const counter = parseInt( $(counter_area).attr('data-count') ) + 1;
            const length = parseInt( $('#notification-items>.dropdown-item').length );
            $(counter_area).attr('data-count', counter);

              const data = `
                <a class="dropdown-item d-flex align-items-center notification-item" href="${notification.url}">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas ${notification.fas} text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">${notification.time}</div>
                    <span class="font-weight-bold">${notification.title}</span>
                  </div>
                </a>
              `;
              
              $(container).prepend(data);

              if(counter<=5){
                $(counter_area).text( counter );
              }else{ 
                $(counter_area).text('5+');
              };

              if(length>=5) $(container).find('.notification-item').last().remove();
            });
          }
        });
      </script>
      <!-- Page level custom scripts -->
      @stack('scripts')

    </body>

    </html>
