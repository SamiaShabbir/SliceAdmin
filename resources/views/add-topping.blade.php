<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pizza Admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <!-- js_grid -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jsgrid/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jsgrid/css/jsgrid-theme.min.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap-Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Switchary -->
    <link href="{{ asset('/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet" />
</head>

<body>
    @include('sweetalert::alert')

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('navbar');

        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <ul aria-expanded="false">
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Product</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="restaurant-menus.html">Veiw Product</a></li>
                                <li><a href="add-menu-item.html">Add Product</a></li>

                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Category</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="veiw-category.html">Veiw Category</a></li>
                                <li><a href="add-category.html">Add Category</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Toppings</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="veiw-toppings.html">Veiw Toppings</a></li>
                                <li><a href="add-toppings.html">Add Toppings</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sauce For Dipping</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="veiw-sauces.html">Veiw Sauces</a></li>
                                <li><a href="add-sauces.html">Add Sauce</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cheese</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="veiw-cheese.html">Veiw Cheese</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Crust</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="veiw-cheese.html">Veiw Crust</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Components</a></li>
                    </ol>
                </div>
            </div>



            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    @if (session()->has('message'))
                        <div class="alert alert-light d-flex align-items-center"
                            style=" width:100%    ; margin-left: 1%;
    margin-right: 1%;  ;background-color:dodgerblue; color:white">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="col-xl-5 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Toppings And Attribute</h4>
                                <div class=" nosrcoll">
                                    <div class="basic-form">
                                        <form method="POST" action="{{ url('add-toppings') }}">
                                            @csrf
                                            <h5>Add Cheese</h5>
                                            <div class="form-row">
                                                <div class="col-6">
                                                    <label class="font-weight-normal"> Title</label>
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="cheese"required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal"> 12" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="12 inch price" name="cheese_price"required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal"> 18" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="18 inch Price" name="cheese_price_18"required>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Add Sauce</h5>
                                            <div class="form-row">
                                                <div class="col-6">
                                                    <label class="font-weight-normal"> Title</label>
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="sauce" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal"> 12" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="12 inch price" name="sauce_price"required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal"> 18" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="18 inch Price" name="sauce_price_18"required>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Add Topping</h5>
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <label class="font-weight-normal"> Title</label>
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        required name="name">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2"> 12" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="12 inch price" name="price" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2"> 18" Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="18 inch Price" name="regular_topping_18"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2"> 12" Less price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder=" less price 12 inch" name="less_price" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2">18" Less price </label>
                                                    <input type="number" class="form-control"
                                                        placeholder="less price 18 inch" name="less_price_18"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2"> 12" Normal Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder=" normal price 12 inch" name="normal_price"
                                                        required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2">18" Normal price </label>
                                                    <input type="number" class="form-control"
                                                        placeholder="normal price 18 inch" name="normal_price_18"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2"> 12" Extra Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder=" extra price 12 inch" name="extra_price"
                                                        required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="font-weight-normal m-2">18" Extra price </label>
                                                    <input type="number" class="form-control"
                                                        placeholder="extra price 18 inch" name="extra_price_18"
                                                        required>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <button class="btn btn-primary m-2 btn-lg" type="submit">Add
                                                    Topping</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->


            <!--**********************************
            Footer start
        ***********************************-->
            <div class="footer">
                <div class="copyright">
                    <p>
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        Developed by
                        <a href="https://www.tecjaunt.com" class="font-weight-bold" target="">Tecjaunt</a>
                        ©</p>
                    </div>
                </div>
                <!--**********************************
            Footer end
        ***********************************-->


                <!--**********************************
            Right sidebar start
        ***********************************-->
                <!--**********************************
            Right sidebar end
        ***********************************-->
            </div>
            <!--**********************************
        Main wrapper end
    ***********************************-->

            <!--**********************************
        Scripts
    ***********************************-->
            <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
            <script src="{{ asset('/js/custom.min.js') }}"></script>
            <script src="{{ asset('/js/settings.js') }}"></script>
            <script src="{{ asset('/js/quixnav.js') }}"></script>
            <script src="{{ asset('/js/styleSwitcher.js') }}"></script>
            <!-- switchery -->
            <script src="{{ asset('/assets/plugins/innoto-switchery/dist/switchery.min.js') }}"></script>
            <!-- JS Grid -->
            <script src="{{ asset('/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('/assets/plugins/jsgrid/js/jsgrid.min.js') }}"></script>
            <!-- JS GRID INTI -->
            <script src="{{ asset('js/plugins-init/jsgrid-init.js') }}"></script>
            <script src="{{ asset('js/plugins-init/footable-init.js') }}"></script>
            <script src="{{ asset('js/plugins-init/jquery.bootgrid-init.js') }}"></script>
            <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
            <!-- switchery init-->
            <script src="{{ asset('js/plugins-init/switchery-init.js') }}"></script>
            <script>
                function myFunction() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                }
            </script>
</body>


</html>
