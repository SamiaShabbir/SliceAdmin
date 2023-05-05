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
    <link href="{{ asset('/public/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap-Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Switchary -->
    <link href="{{ asset('/public/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet" />
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
                    <div class="breadcrumb-range-picker">
                    </div>
                </div>
            </div>
            <!-- row -->
            @if (session()->has('message'))
                <div class="alert alert-light d-flex align-items-center" style="color: black ">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="container-fluid">
                <div class="container">
                    <div class="addProductWrapper">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-lg-10 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                                <h4 class="text-center breadColor">Edit cheese</h4>
                                <br />
                                <div class="basic-form">
                                    <form id="add-user-form">
                                        @csrf
                                        <div id="edit_sauces">

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-danger btn-lg m-3"> Save Product
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
    <script src="{{ asset('public/assets/plugins/common/common.min.js') }}"></script>
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
    <script src="{{ asset('public/js/plugins-init/jsgrid-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/footable-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/jquery.bootgrid-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/datatables.init.js') }}"></script>
    <!-- switchery init-->

    <script src="{{ asset('public/js/plugins-init/switchery-init.js') }}"></script>
    <script>
        $(document).ready(function() {
            let edit_id = localStorage.getItem("emp_id");

            veiwProduct()
            var form = '#add-user-form';

            function veiwProduct() {
                var $list = $("#edit_sauces");
                $.ajax({
                    url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-coupons/${edit_id}`,
                    type: "GET",
                    success: function(data) {
                        var count = 1;
                        if (data.status == "success") {
                            $.each(data.data, function(index, obj) {

                                console.log(obj.id)
                                $list.append(
                                    ' <div class="form-group">' +
                                    ' <input class="form-control mb-2" id="name" value="' +
                                    obj.coupon_number +
                                    '" type="text"  name="coupon_number"required>' +
                                    '<div class="form-group">' +
                                    '<label>Choose Type of Discount</label> <br/>' +
                                    '<label for="mailclient14" class="mailclinet mailclinet-another w-100">' +
                                    '<input type="radio" default name="type" id="mailclient14" value="percentage" checked>' +
                                    '<span class="mail-icon">' +
                                    '<i class="fa fa-question-circle-o" aria-hidden="true"></i>' +
                                    '</span>' +
                                    '<span class="mail-text">Percentage</span>' +
                                    '</label>' +
                                    '<label for="mailclient14" class="mailclinet mailclinet-another">' +
                                    '<input type="radio" name="type" id="mailclient14" value="amount">' +
                                    '<span class="mail-icon">' +
                                    '<i class="fa fa-question-circle-o" aria-hidden="true"></i>' +
                                    '</span>' +
                                    '<span class="mail-text">Amount</span>' +
                                    '</label>' +
                                    '</div>' +
                                    ' <input class="form-control mb-2" id="name" value="' +
                                    obj.discount +
                                    '" type="text"  name="discount" required>' +
                                    ' <input class="form-control mb-2" id="name" value="' +
                                    obj.expiry_date +
                                    '" type="text"  name="expiry_date" required>' +
                                    '</div>');
                            });
                        } else {
                            console.log("error")
                        }
                    },
                    error: function(data) {}
                });
            }

            $("#add-user-form").on('submit', function(event) {
                event.preventDefault();

                var url = $(this).attr('data');

                $.ajax({
                    url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-coupons/${edit_id}`,
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == "success") {
                            fireSweetAlert()
                            window.location.href =
                                "http://esan.megaenterprisegroup.com/pizzaAdmin/view-coupons";
                        } else {
                            showError()
                        }
                    },
                    error: function(response) {}
                });
            });

        });

        function fireSweetAlert() {
            Swal.fire(
                'Good job!',
                'Item have been Updated!',
                "success"
            )
        }

        function showError() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            })
        }

        function removeValue1() {
            var name = document.getElementById("name");
            name.value = " ";
        }

        function removeValue2() {
            var desc = document.getElementById("desc");
            desc.value = " ";
        }

        function removeValue3() {
            var price = document.getElementById("price");
            price.value = " ";
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
