<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pizza Admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon.png') }}">
    <!-- js_grid -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jsgrid/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jsgrid/css/jsgrid-theme.min.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap-Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Switchary -->
    <link href="{{ asset('public/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="{{ asset('/public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}">
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
                        <h2 class="page-heading">Hi,Welcome Back!</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="addProductWrapper">
                        <h4 class="text-center">Build Your Pizza</h4>

                        <form id="add-user-form">
                            @csrf
                            <div id="edit-product">
                                <div id="wrapper">
                                    <hr />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" id="submit" class="btn btn-primary btn-lg m-3"> Update
                                    </button>
                                </div>
                            </div>

                        </form>
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

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
                    <script src="{{ asset('public/assets/plugins/common/common.min.js') }}"></script>
                    <script src="{{ asset('/public/js/custom.min.js') }}"></script>
                    <script src="{{ asset('/public/js/settings.js') }}"></script>
                    <script src="{{ asset('/public/js/quixnav.js') }}"></script>
                    <script src="{{ asset('/public/js/styleSwitcher.js') }}"></script>
                    <script src="{{ asset('/public/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
                    <!-- switchery -->
                    <script src="{{ asset('/public/assets/plugins/innoto-switchery/dist/switchery.min.js') }}"></script>
                    <!-- JS Grid -->
                    <script src="{{ asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
                    <script src="{{ asset('/public/assets/plugins/jsgrid/js/jsgrid.min.js') }}"></script>
                    <!-- JS GRID INTI -->
                    <script src="{{ asset('public/js/plugins-init/jsgrid-init.js') }}"></script>
                    <script src="{{ asset('public/js/plugins-init/footable-init.js') }}"></script>
                    <script src="{{ asset('public/js/plugins-init/jquery.bootgrid-init.js') }}"></script>
                    <script src="{{ asset('public/js/plugins-init/datatables.init.js') }}"></script>
                    <!-- switchery init-->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        $(document).ready(function() {
                            getYourOwn();
                            var form = '#add-user-form';
                            $(form).on('submit', function(event) {
                                event.preventDefault();
                                var url = $(this).attr('data-action');

                                $.ajax({
                                    url: 'http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-build-pizza/1',
                                    method: "POST",
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.status === "success") {
                                            showSuccessAlert();
                                            location.reload();
                                        } else {
                                            showError();
                                        }
                                    },
                                    error: function(response) {}
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

                            function showError() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                })
                            }
                        });

                        function getYourOwn() {

                            var $list = $("#wrapper");

                            $.ajax({
                                url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-your-own/1`,
                                type: "GET",
                                success: function(data) {
                                    var count = 1;
                                    if (data.status == "success") {
                                        $.each(data.data, function(index, obj) {
                                            console.log(obj.id)
                                            $list.append(
                                                '<div class="size line row">' +
                                                '<div class="col-4">' +
                                                '</div>' +
                                                '<div class="col-4 text-start fw-bold fs-3 text-dark">' +
                                                ' <b>' +
                                                '12"' +
                                                '</b>' +
                                                '</div>' +
                                                '<div class="col-4 text-start fw-bold fs-3 text-dark">' +
                                                '<b>18"</b>' +
                                                '</div>' +
                                                '</div>' +
                                                '<hr/>' +
                                                '<div class="size line row">' +
                                                '<div class="col-4"> ' +
                                                '<h5 class="fs-4 mt-2"> Price ($) for Dough</h5>' +
                                                '</div>' +
                                                '<div class="col-4 text-start fw-bold fs-3 text-dark">' +
                                                '<div class="form-group">' +
                                                '<input id="doughValue12" type="number" value="' + obj
                                                .dough_price1 + '" name="dough_price1" class="form-control">' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4 text-start fw-bold fs-3 text-dark"> ' +
                                                '<div class="form-group">' +
                                                '<input id="doughValue18" type="number" value="' + obj
                                                .dough_price2 + '" name="dough_price2" class="form-control">' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Cheese </h5>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="m-2">' +
                                                '<label>' +
                                                'No Cheese</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class=" d-flex m-1" id="1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.no_cheese_price_12 +
                                                '" name="no_cheese_price_12" class="form-control no-cheese1" ></div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class=" d-flex m-1" id="2"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.no_cheese_price_18 +
                                                '" name="no_cheese_price_18" class="form-control no-cheese2" ></div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                '<label>' +
                                                'Less</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                ' <div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.less_cheeses_price_12 +
                                                '" name="less_cheeses_price_12" class="form-control less1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.less_cheeses_price_18 +
                                                '" name="less_cheeses_price_18" class="form-control less2">' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                '<label>' +
                                                'Normal</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.normal_cheese_price_12 +
                                                '" name="normal_cheese_price_12" class="form-control none1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.normal_cheese_price_18 +
                                                '" name="normal_cheese_price_18" class="form-control none2" >' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Sauce </h5>' +
                                                ' </div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                '<label>' +
                                                'Robust</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.rebust_price_12 +
                                                '" name="rebust_price_12" class="form-control Robust1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.rebust_price_18 +
                                                '" name="rebust_price_18" class="form-control Robust2" >' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                '<label>' +
                                                ' Honey BBQ Sauce</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.honey_BBQ_price_12 +
                                                '" name="honey_BBQ_price_12" class="form-control Honey-BBQ-Sauce1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.honey_BBQ_price_18 +
                                                '" name="honey_BBQ_price_18" class="form-control Honey-BBQ-Sauce2" >' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                ' <label>' +
                                                ' Ranch</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                ' <span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.ranch_price_12 +
                                                '" name="ranch_price_12" class="form-control Ranch1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.ranch_price_18 +
                                                '" name="ranch_price_18" class="form-control Ranch2" >' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="radio m-2">' +
                                                ' <label>' +
                                                'None</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                ' <span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.none_sauce_price_12 +
                                                '" name="none_sauce_price_12" class="form-control None1" >' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<div class="d-flex m-1">' +
                                                '<span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.none_sauce_price_18 +
                                                '" name="none_sauce_price_18" class="form-control None2">' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Toppings </h5>' +
                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +

                                                '</div>' +
                                                '<div class="col-4">' +
                                                '<h5 class="fs-4 m-2 text-dark">Price for calculation </h5>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row mt-3">' +
                                                '<div class="col-4">' +
                                                '</div>' +
                                                '<div class="col-4 d-flex justify-content-around">' +
                                                '<h5 class="text-center text-secondary fs-6 fw-light">Half Pizza</h5>' +

                                                '<h5 class="text-center text-secondary fs-6 fw-light">Full Pizza </h5>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex justify-content-around">' +
                                                '<h5 class="text-center text-secondary fs-6 fw-light">Half Pizza</h5>' +

                                                '<h5 class="text-center text-secondary fs-6 fw-light">Full Pizza </h5>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row ">' +
                                                '<div class="col-4">' +
                                                '<div class=" m-2">' +
                                                '<label class="form-check-label" for="check1">Mushrooms</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_1_12 +
                                                '" name="topping_half_1_12" class="form-control mushroom1"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_1_12_price +
                                                '" name="toppng_full_1_12_price" class="form-control mushroomHalf1"></div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_1_18 +
                                                '" name="topping_half_1_18" class="form-control mushroom2"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_1_18_price +
                                                '" name="toppng_full_1_18_price" class="form-control mushroomHalf2"></div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class=" m-2">' +
                                                '<label class="form-check-label" for="check1">Onion</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_2_12 +
                                                '" name="topping_half_2_12" class="form-control onion1"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_2_12_price +
                                                '" name="toppng_full_2_12_price" class="form-control onionHalf1"></div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_2_18 +
                                                '" name="topping_half_2_18" class="form-control onion2"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_2_18_price +
                                                '" name="toppng_full_2_18_price" class="form-control onionHalf2"></div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class="m-2">' +
                                                ' <label class="form-check-label" for="check1">Black Pepper</label>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_3_12 +
                                                '" name="topping_half_3_12" class="form-control blackPepper1"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_3_12_price +
                                                '" name="toppng_full_3_12_price" class="form-control blackPepperHalf1"></div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_3_18 +
                                                '" name="topping_half_3_18" class="form-control blackPepper2"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_3_18_price +
                                                '" name="toppng_full_3_18_price" class="form-control blackPepperHalf2"></div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="row">' +
                                                '<div class="col-4">' +
                                                '<div class=" m-2">' +
                                                '<label class="form-check-label" for="check1"> Capisum</label>' +
                                                ' </div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_4_12 +
                                                '" name="topping_half_4_12" class="form-control capisum1"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_4__12_price +
                                                '" name="toppng_full_4__12_price" class="form-control capisumHalf1"></div>' +
                                                '</div>' +
                                                '<div class="col-4 d-flex">' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.topping_half_4_18 +
                                                '" name="topping_half_4_18" class="form-control capisum2"></div>' +
                                                '<div class="d-flex m-1"><span class="mt-2">$</span><input id="demo0" type="number" value="' +
                                                obj.toppng_full_4_18_price +
                                                '" name="toppng_full_4_18_price" class="form-control capisumHalf2"></div>' +
                                                '</div>'
                                            );
                                        });
                                    } else {
                                        console.log("error")
                                    }
                                },
                                error: function(data) {}
                            });
                        }
                    </script>
</body>


</html>
