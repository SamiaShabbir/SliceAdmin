<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Pizza Admin Panel</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/assets/images/favicon.png')}}">
        <!-- js_grid -->
        <link rel="stylesheet" href="{{asset('public/assets/plugins/jsgrid/css/jsgrid.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/jsgrid/css/jsgrid-theme.min.css')}}">

        <!-- Custom Stylesheet -->
        <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
        <!-- Bootstrap-Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Switchary -->
        <link href="{{asset('public/assets/plugins/innoto-switchery/dist/switchery.min.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('/public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </head>

    <body>

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
            <div class="nav-header">
                <div class="brand-logo">
                    <b class="logo-abbr">D</b>
                    <span class="brand-title"><b>Dashboard</b></span>
                </div>
            </div>
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
            @include('sidebar')

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
                </div>                                                                                     
                <div class="container-fluid">
                    <div class="row justify-content-between mb-3">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <h2 class="page-heading text-capitalize">Hi,Welcome Back!</h2>
                        </div>
                    </div>
                    <div class="container">
                        <div class="addProductWrapper">

                            <div class="row d-flex justify-content-center flex-column  align-items-center">
                                <h4>Add Product</h4>
                                <div class="col-lg-10 shadow-sm p-3 mb-5 bg-body-tertiary rounded">

                                    <div class="basic-form">
                                        <form id="add-user-form">
                                            @csrf
                                            <div id="edit-product">
                                                <div class="form-group">
                                                    <h5 class="fs-3 text-dark fw-bold text-capitalize">Name:</h5>
                                                    <input class="form-control mb-2 d-none" id="name" type="text" placeholder="Enter Product Name" value="Pizza" name="cat_name" >
                                                    <input class="form-control mb-2 d-none" id="name" type="number"
                                                           placeholder="Enter Product Name" value="12" name="size1">
                                                    <input class="form-control mb-2 d-none" id="name" type="number"
                                                           placeholder="Enter Product Name" value="18" name="size2">
                                                    <input class="form-control mb-2" id="name" type="text" placeholder="Enter Product Name" name="name" required>

                                                    <div class="form-group">
                                                        <label>Choose Category</label>
                                                        <select id="category" class="form-control text-capitalize"
                                                                name="sub_cat_name"required>
                                                            @foreach ($get_sub_category_list as $sub_cat)
                                                            <option class="text-capitalize"
                                                                    value="{{ $sub_cat->name }}">
                                                                {{ $sub_cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <h5 class="card-title mt-5 fs-3 text-dark fw-bold">Description</h5>
                                                    <div class="basic-form">
                                                        <form>
                                                            <div class="form-group">
                                                                <textarea class="form-control" minlength="10"  rows="3" id="desc" name="description" required></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <h5 class="fs-3 text-dark fw-bold text-capitalize">Product Image</h5>
                                                    <div class="input-group uploadDiv mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">

                                                        <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0 d-none" name="image">
                                                        <label id="upload-label" for="upload" class="font-weight-light text-muted m-2" required>Upload image</label>
                                                        <div class="input-group-append">
                                                            <label for="upload" class="btn ButtonUpload text-white m-0 rounded-pill px-4"><small class="text-uppercase font-weight-bold text-muted text-white">Choose file</small></label>
                                                        </div>
                                                    </div>
                                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block w-50"></div>
                                                    <hr/>
                                                    <div class="Wrapper">
                                                        <div class="size line row">
                                                            <div class="col-4"></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"> <b>12"</b></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"><b>18"</b></div>
                                                        </div>
                                                        <hr/>
                                                        <div class="size line row m-2">
                                                            <div class="col-4"><h5 class="fs-4 m-2 text-capitalize"> Price ($) for Display</h5></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"> <div class="form-group">
                                                                    <input id="result1" type="number" value="" name="price1" class="form-control">
                                                                </div></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"> <div class="form-group">
                                                                    <input id="result2" type="number" value="" name="price2" class="form-control">
                                                                </div></div>
                                                        </div>
                                                        <div class="size line row m-2">
                                                            <div class="col-4"> <h5 class="fs-4 m-2 text-capitalize"> Price ($) for Dough</h5></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"> <div class="form-group">
                                                                    <input id="doughValue12" type="number" value="" name="dough_price1" class="form-control">
                                                                </div></div>
                                                            <div class="col-4 text-start fw-bold fs-3 text-dark"> <div class="form-group">
                                                                    <input id="doughValue18" type="number" value="" name="dough_price2" class="form-control">
                                                                </div></div>
                                                        </div>
                                                        <div class="row m-2">
                                                            <div class="col-6">
                                                                <h5 class="text-dark fs-3 text-capitalize">Cheese <small>(Choosed item will be auto select on App)</small></h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <!--<h5 class="text-dark fs-3 text-capitalize">Price for calculation </h5>-->
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row m-2 border-bottom pb-4">
                                                            @foreach($cheese as $cheez)
                                                            <div class="col-6">
                                                                <div class="radio">
                                                                    <input type="radio" class="form-check-input" name="cheese_item" id="cheez_{{$cheez->id}}" value="{{$cheez->cheese}}" >
                                                                    <label class="form-check-label" for="cheez_{{$cheez->id}}">{{$cheez->cheese}}
                                                                        <br/>
                                                                        <small>(
                                                                        12" Cheese Price: {{'$' . $cheez->cheese_price}} and
                                                                        18" Cheese Price: {{'$' . $cheez->cheese_price_18}}
                                                                        )</small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            <!--<div class="col-4">-->
                                                            <!--    <div class=" d-flex m-2" id="1"><span class="m-2">$</span><input id="demo0" type="number" value="" name="no_cheese_price_12" class="form-control no-cheese1"></div>-->
                                                            <!--</div>-->
                                                            <!--<div class="col-4">-->
                                                            <!--    <div class=" d-flex m-2" id="2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="no_cheese_price_18" class="form-control no-cheese2" ></div>-->
                                                            <!--</div>-->
                                                        </div>
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="cheese_free" value="less"> Less</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="less_cheese_price_12" class="form-control less1"></div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="less_cheese_price_18" class="form-control less2" ></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="cheese_free" value="normal"> Normal</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="normal_cheese_price_12" class="form-control none1" ></div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="normal_cheese_price_18" class="form-control none2" ></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!-- sauce -->
                                                        <div class="row m-2">
                                                            <div class="col-6">
                                                                <h5 class="text-dark fs-3 text-capitalize">Sauce <small>(Choosed item will be auto select on App)</small></h5>
                                                            </div>
                                                            <div class="col-6">
                                                                <!--<h5 class="text-dark fs-3 text-capitalize">Price for calculation </h5>-->
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row m-2 border-bottom pb-4">
                                                            @foreach($sauce as $cheez)
                                                            <div class="col-6">
                                                                <div class="radio">
                                                                    <input type="radio" class="form-check-input" name="sauce_item" id="sauce_{{$cheez->id}}" value="{{$cheez->sauce}}" >
                                                                    <label class="form-check-label" for="sauce_{{$cheez->id}}">{{$cheez->sauce}}
                                                                        <br/>
                                                                        <small>(
                                                                        12" Sauce Price: {{'$' . $cheez->sauce_price}} and
                                                                        18" Sauce Price: {{'$' . $cheez->sauce_price_18}}
                                                                        )</small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <h5 class="text-dark fs-3 m-1 text-capitalize">Sauce </h5>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <h5 class="text-dark m-1 fs-3 text-capitalize">Price for calculation </h5>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <h5 class="text-dark m-1 fs-3 text-capitalize">Price for calculation </h5>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="sauce_free" value="Robust"> Robust</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="Robust_price_12" class="form-control Robust1" ></div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="Robust_price_18" class="form-control Robust2" ></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="sauce_free" value="Honey BBQ Sauce"> Honey BBQ Sauce</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="BBQ_price_12" class="form-control Honey-BBQ-Sauce1" ></div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="BBQ_price_18" class="form-control Honey-BBQ-Sauce2" ></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="sauce_free" value="Ranch"> Ranch</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="ranch_price_12" class="form-control Ranch1" ></div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="ranch_price_18" class="form-control Ranch2"></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--<div class="row m-2">-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="radio m-2">-->
                                                        <!--            <label>-->
                                                        <!--                <input type="radio" name="sauce_free" class="None" value="None"> None</label>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="no_sauce_price_12" class="form-control None1" > </div>-->
                                                        <!--    </div>-->
                                                        <!--    <div class="col-4 mb-1">-->
                                                        <!--        <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="no_sauce_price_18" class="form-control None2" ></div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!-- topping -->
                                                        <div class="row m-2">
                                                            <div class="col-4">
                                                                <h5 class="text-dark m-1 fs-3 text-capitalize">Toppings </h5>
                                                            </div>
                                                            <div class="col-4">
                                                                <!--<h5 class="text-dark m-1 fs-3 text-capitalize">Price for calculation </h5>-->
                                                            </div>
                                                            <div class="col-4">
                                                                <!--<h5 class="text-dark m-1 fs-3 text-capitalize">Price for calculation </h5>-->
                                                            </div>
                                                        </div>
                                                        <div class="row m-2">
                                                            @foreach($regular_toppings as $topping)
                                                            <div class="col-5">
                                                                <div class="form-check m-2">
                                                                    <input type="checkbox" class="form-check-input" name="topping_free[]" id="topping_{{$topping->id}}" value="{{$topping->regular_toppings}}" >
                                                                    <label class="form-check-label" for="topping_{{$topping->id}}">{{$topping->regular_toppings}}
                                                                        <br/>
                                                                        <small>(Regular: {{'$' . $topping->regular_topping_price}}, 
                                                                                Less: {{'$' . $topping->less_price}}, 
                                                                                Normal: {{'$' . $topping->normal_price}},
                                                                                Extra: {{'$' . $topping->extra_price}},
                                                                                
                                                                                )</small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endforeach 
<!--                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="Mushroom_price_12" class="form-control mushroom1"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="Mushroom_price_18" class="form-control mushroom2"></div>
                                                            </div>-->
                                                        </div>
<!--                                                        <div class="row m-2">
                                                            <div class="col-4">
                                                                <div class="form-check m-2">
                                                                    <input type="checkbox" class="form-check-input" name="topping_free" id="check1" value="Onion" >
                                                                    <label class="form-check-label" for="check1">Onion</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="onion_price_12" class="form-control onion1"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="onion_price_18" class="form-control onion2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-2">
                                                            <div class="col-4">
                                                                <div class="form-check m-2">
                                                                    <input type="checkbox" class="form-check-input" name="topping_free" id="check1" value="Black-Pepper" >
                                                                    <label class="form-check-label" for="check1">Black Pepper</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="black_pepper_price_12" class="form-control blackPepper1"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="black_pepper_price_18" class="form-control blackPepper2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-2">
                                                            <div class="col-4">
                                                                <div class="form-check m-2">
                                                                    <input type="checkbox" class="form-check-input" name="topping_free" id="check1" value="Capisum" >
                                                                    <label class="form-check-label" for="check1"> Capisum</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="capsium_price_12" class="form-control capisum1"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex m-2"><span class="m-2">$</span><input id="demo0" type="number" value="" name="capsium_price_18" class="form-control capisum2"></div>
                                                            </div>
                                                        </div>-->
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" id="submit" class="btn btn-primary btn-lg m-3"> Save Product </button>
                                                        </div>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
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
                    <p><div class="copyright text-center text-sm text-muted text-lg-start">
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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            <script src="{{asset('public/assets/plugins/common/common.min.js')}}"></script>
            <script src="{{asset('/public/js/custom.min.js')}}"></script>
            <script src="{{asset('/public/js/settings.js')}}"></script>
            <script src="{{asset('/public/js/quixnav.js')}}"></script>
            <script src="{{asset('/public/js/styleSwitcher.js')}}"></script>
            <script src="{{asset('/public/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
            <!-- switchery -->
            <script src="{{asset('/public/assets/plugins/innoto-switchery/dist/switchery.min.js')}}"></script>
            <!-- JS Grid -->
            <script src="{{asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
            <script src="{{asset('/public/assets/plugins/jsgrid/js/jsgrid.min.js')}}"></script>
            <!-- JS GRID INTI -->
            <script src="{{ asset('public/js/plugins-init/jsgrid-init.js')}}"></script>
            <script src="{{ asset('public/js/plugins-init/footable-init.js')}}"></script>
            <script src="{{ asset('public/js/plugins-init/jquery.bootgrid-init.js')}}"></script>
            <script src="{{ asset('public/js/plugins-init/datatables.init.js')}}"></script>
            <!-- switchery init-->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
        $(document).ready(function () {
            var form = '#add-user-form';
            $(form).on('submit', function (event) {
                event.preventDefault();
                var url = $(this).attr('data-action');

                $.ajax({
                    url: 'http://esan.megaenterprisegroup.com/pizzaAdmin/api/add-pizza',
                    method: "POST",
                    data: new FormData(this)
                    ,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response)
                    {
                        if (response.status === "success") {
                            showSuccessAlert()
                            window.location.href = "http://esan.megaenterprisegroup.com/pizzaAdmin/menu";
                        } else {
                            showError();
                        }
                    },
                    error: function (response) {
                    }
                });
            });
            let radioBtn = document.querySelector('.radioBtn');
            console.log(radioBtn.value);
            function showSuccessAlert() {
                Swal.fire(
                        'Good job!',
                        'Product added SuccessFully!',
                        'success'
                        )
            }
        });
        let cheeseValue1 = 0;
        let cheeseValue2 = 0;
        let sauceValue1 = 0;
        let sauceValue2 = 0;
        let toppingValue1 = 0;
        let toppingValue2 = 0;
        let doughValue1 = 0;
        let doughValue2 = 0;
        let sum1 = 0;
        let sum2 = 0;
        let finalSum1;
        let finalSum2;
        function calSum() {
            var totalSum_12 = parseInt(doughValue1) + parseInt(cheeseValue1) + parseInt(sauceValue1) + sum1;
            var totalSum_18 = parseInt(doughValue2) + parseInt(cheeseValue2) + parseInt(sauceValue2) + sum2;
            finalSum1 = totalSum_12;
            finalSum2 = totalSum_18;
        }
        let doughValueFor12 = document.querySelector("#doughValue12").value;
        let doughValueFor18 = document.querySelector("#doughValue18").value;
        console.log(doughValueFor12);
        console.log(doughValueFor18);
        $("#doughValue12").on("change", function () {
            let doughValueFor12 = document.querySelector("#doughValue12").value;
            doughValue1 = doughValueFor12;
            calSum()
            displaySum();
        })
        $("#doughValue18").on("change", function () {
            let doughValueFor18 = document.querySelector("#doughValue18").value;
            doughValue2 = doughValueFor18;
            calSum()
            displaySum();
        })
        const radioButtons = document.querySelectorAll('input[name="cheese_free"]');
        $(radioButtons).on('change', function (e) {
            console.log(this.value)
            if (this.checked) {
                switch (this.value) {
                    case 'no-cheese':
                    {
                        let cheese1 = document.querySelector('.no-cheese1').value;
                        console.log(cheese1)
                        cheeseValue1 = parseInt(cheese1);
                        console.log(cheeseValue1);
                        let cheese2 = document.querySelector('.no-cheese2').value;
                        cheeseValue2 = parseInt(cheese2);
                        console.log(cheeseValue2);
                        calSum();
                        displaySum();
                        break;
                    }
                    case "less":
                    {

                        let less1 = document.querySelector('.less1').value;
                        cheeseValue1 = parseInt(less1);
                        console.log(cheeseValue1);
                        calSum();
                        displaySum();
                        let less2 = document.querySelector('.less2').value;
                        cheeseValue2 = parseInt(less2);
                        console.log(cheeseValue2);
                        calSum();
                        displaySum();
                        break;
                    }
                    case "normal":
                    {
                        let n1 = document.querySelector('.none1').value;
                        cheeseValue1 = parseInt(n1);
                        console.log(cheeseValue1);
                        calSum();
                        displaySum();
                        let n2 = document.querySelector('.none2').value;
                        cheeseValue2 = parseInt(n2);
                        console.log(cheeseValue2);
                        calSum();
                        displaySum();
                        break;
                    }
                    default:
                    {
                    }
                }
            }
        });
        $()
        const sauceRadioButtons = document.querySelectorAll('input[name="sauce_free"]');
        console.log(sauceRadioButtons);
        $(sauceRadioButtons).on('change', function (e) {
            if (this.checked) {
                switch (this.value) {
                    case 'Robust':
                    {
                        let rebust1 = document.querySelector('.Robust1').value;
                        sauceValue1 = parseInt(rebust1);
                        calSum();
                        displaySum();
                        let rebust2 = document.querySelector('.Robust2').value;
                        sauceValue2 = parseInt(rebust2);
                        calSum();
                        displaySum();
                        break;
                    }
                    case "Honey BBQ Sauce":
                    {
                        let honey1 = document.querySelector('.Honey-BBQ-Sauce1').value;
                        sauceValue1 = parseInt(honey1);
                        calSum();
                        displaySum();
                        let honey2 = document.querySelector('.Honey-BBQ-Sauce2').value;
                        sauceValue2 = parseInt(honey2);
                        calSum();
                        displaySum();
                        break;
                    }
                    case "Ranch":
                    {

                        let ranch1 = document.querySelector('.Ranch1').value;
                        sauceValue1 = parseInt(ranch1);
                        calSum();
                        displaySum();

                        let ranch2 = document.querySelector('.Ranch2').value;
                        sauceValue2 = parseInt(ranch2);
                        calSum();
                        displaySum();
                        break;
                    }
                    case "None":
                    {
                        let none1 = document.querySelector('.None1').value;
                        sauceValue1 = parseInt(none1);
                        calSum();
                        displaySum();
                        let none2 = document.querySelector('.None2').value;
                        sauceValue2 = parseInt(none2);
                        calSum();
                        displaySum();
                        break;
                    }
                    default:
                    {
                    }
                }
            }
        });
        const toppingsCheck = document.querySelectorAll('[name=topping_free]');
        $(toppingsCheck).on("change", function (e) {
            console.log(this.value);
            switch (this.value) {
                case "Mushrooms":
                    let m1 = document.querySelector('.mushroom1').value;
                    console.log(m1);
                    sum1 = sum1 + parseInt(m1);
                    calSum();
                    displaySum();
                    let m2 = document.querySelector('.mushroom2').value;
                    sum2 = sum2 + parseInt(m2);
                    calSum();
                    displaySum();
                    break;
                case "Onion":
                    let o1 = document.querySelector('.onion1').value;
                    sum1 = sum1 + parseInt(o1);
                    calSum();
                    displaySum();
                    let o2 = document.querySelector('.onion2').value;
                    sum2 = sum2 + parseInt(o2);
                    calSum();
                    displaySum();
                    break;
                case "Black-Pepper":
                    let b1 = document.querySelector('.blackPepper1').value;
                    sum1 = sum1 + parseInt(b1);
                    calSum();
                    displaySum();

                    let b2 = document.querySelector('.blackPepper2').value;
                    sum2 = sum2 + parseInt(b2);
                    calSum();
                    displaySum();

                    break;
                case "Capisum":

                    let cap1 = document.querySelector('.capisum1').value;
                    sum1 = sum1 + parseInt(cap1);
                    calSum();
                    displaySum();

                    let cap2 = document.querySelector('.capisum2').value;
                    sum2 = sum2 + parseInt(cap2);
                    calSum();
                    displaySum();
                    break;

                default:
                    console.log("not selected")
                    break;
            }
        })
        function displaySum() {
            var result1 = document.querySelector("#result1");
            var result2 = document.querySelector("#result2");
            result1.value = finalSum1;
            result2.value = finalSum2;
        }

        function showError() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            })
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                console.log(input)
                reader.onload = function (e) {
                    $('#imageResult')
                            .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function () {
            $('#upload').on('change', function () {
                readURL(input);
                console.log(input.value)
            });
        });
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);
        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
            </script>
    </body>


</html>