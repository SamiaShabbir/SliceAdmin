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
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Components</a></li>
                    </ol>
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
                                <h4 class="text-center breadColor">Edit Sauces</h4>
                                <br />
                                <div class="basic-form">
                                    <form action="{{ url('/pizza-admin/add-dipping-sauce') }}" method="POST"
                                        enctype="multipart/form-data" id="add-user-form">
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
            // alert(edit_id);
            veiwProduct()
            var form = '#add-user-form';

            function veiwProduct() {
                // alert("hello world")
                var $list = $("#edit_sauces");
                // const params = new URLSearchParams(edit_id);
                // alert(edit_id)
                $.ajax({
                    url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-sauce/${edit_id}`,
                    type: "GET",
                    success: function(data) {
                        var count = 1;
                        if (data.status == "success") {
                            $.each(data.data, function(index, obj) {

                                console.log(obj.id)
                                $list.append(
                                    ' <div class="form-group">' +
                                    ' <input class="form-control mb-2" id="name" value="' +
                                    obj.name + '" type="text"  name="name"required>' +
                                    '<div class="form-group">' +

                                    '</div>' +
                                    '<label>Price</label>' +
                                    '<input class="form-control mb-2" id="price" type="number" value="' +
                                    obj.price + '" name="price" required>' +
                                    '<label>Product Image</label>' +
                                    '<div class="input-group uploadDiv mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">' +

                                    '<input id="upload" type="file" value="' + obj.image +
                                    '" onchange="{readURL(this)}" class="form-control border-0 d-none" name="image">' +
                                    ' <label id="upload-label" for="upload" class="font-weight-light text-muted m-2 " required>upload Image</label>' +
                                    '<div class="input-group-append">' +
                                    '<label for="upload" class="btn ButtonUpload text-white m-0 rounded-pill px-4"><small class="text-uppercase font-weight-bold text-muted text-white">Choose file</small></label>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="image-area mt-4"><img id="imageResult" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                                    obj.image +
                                    '" alt="" class="img-fluid rounded shadow-sm mx-auto d-block w-50"></div>' +
                                    '</div>' +
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
                    url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-sauce/${edit_id}`,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'html',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response) {
                            fireSweetAlert()
                            window.location.href =
                                "http://esan.megaenterprisegroup.com/pizzaAdmin/view-sauces";
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
