<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>pizza admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/public/assets/images/favicon.png') }}">
    <!-- js_grid -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jsgrid/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jsgrid/css/jsgrid-theme.min.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap-Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Switchary -->
    <link href="{{ asset('public/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet" />
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
            <!-- row -->
            <!-- @if (session()->has('message'))
<div class="alert alert-light d-flex align-items-center" style="color: black ">
                {{ session()->get('message') }}
            </div>
@endif -->
            <div class="container-fluid">
                <div class="container">
                    <div class="addProductWrapper">

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-lg-10 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                                <h4 class="text-center breadColor">Add Pizza Category</h4>

                                <div class="basic-form">
                                    <form id="add-user-form">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control mb-2" type="text" placeholder="Enter Text"
                                                name="sub_cat_name" required>

                                            <input class="form-control mb-2" type="number" placeholder="Enter ID"
                                                name="category_id" required>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-danger btn-lg m-3"> Save
                                                </button>
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
        <script src="{{ asset('/public/assets/plugins/common/common.min.js') }}"></script>
        <script src="{{ asset('/public/js/custom.min.js') }}"></script>
        <script src="{{ asset('/public/js/settings.js') }}"></script>
        <script src="{{ asset('/public/js/quixnav.js') }}"></script>
        <script src="{{ asset('/public/js/styleSwitcher.js') }}"></script>
        <!-- switchery -->
        <script src="{{ asset('/public/assets/plugins/innoto-switchery/dist/switchery.min.js') }}"></script>
        <!-- JS Grid -->
        <script src="{{ asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/public/assets/plugins/jsgrid/js/jsgrid.min.js') }}"></script>
        <!-- JS GRID INTI -->
        <script src="{{ asset('/public/js/plugins-init/jsgrid-init.js') }}"></script>
        <script src="{{ asset('/public/js/plugins-init/footable-init.js') }}"></script>
        <script src="{{ asset('/public/js/plugins-init/jquery.bootgrid-init.js') }}"></script>
        <script src="{{ asset('/public/js/plugins-init/datatables.init.js') }}"></script>
        <!-- switchery init-->

        <script src="{{ asset('/public/js/plugins-init/switchery-init.js') }}"></script>
        <script>
            $(document).ready(function() {

                var form = '#add-user-form';

                $(form).on('submit', function(event) {
                    event.preventDefault();

                    var url = $(this).attr('data-action');
                    $.ajax({
                        url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/add-sub-category",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == "success") {
                                showSuccessAlert();
                                window.location.href =
                                    "http://esan.megaenterprisegroup.com/pizzaAdmin/pizza-category";
                            } else {
                                showError();
                            }

                        },
                        error: function() {}
                    });
                });

            });

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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imageResult')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(function() {
                $('#upload').on('change', function() {
                    readURL(input);
                });
            });

            /*  ==========================================
                SHOW UPLOADED IMAGE NAME
            * ========================================== */
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
