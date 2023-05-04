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
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
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

                        <div class="row d-flex justify-content-center flex-column  align-items-center">
                            <h4>Add Product</h4>
                            <div class="col-lg-10 shadow-sm p-3 mb-5 bg-body-tertiary rounded">

                                <div class="basic-form">
                                    <form id="add-user-form">
                                        @csrf
                                        <div id="edit-product">
                                            <div class="form-group">
                                                <input class="form-control mb-2" id="name" type="text"
                                                    placeholder="Enter Product Name" name="name"required>
                                                <div class="form-group">
                                                    <label>Choose Category</label>
                                                    <select id="category" class="form-control text-capitalize"
                                                        name="cat_name"required>
                                                        @foreach ($get_category as $cat)
                                                            <option class="text-capitalize {{ $cat->name }}cat"
                                                                value="{{ $cat->name }}">
                                                                {{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <h4 class="card-title mt-5">Description</h4>
                                                <div class="basic-form">
                                                    <form>
                                                        <div class="form-group">
                                                            <textarea class="form-control" minlength="10" rows="3" id="desc" name="description" required></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <label>Price</label>
                                                <input class="form-control mb-2" id="price" type="number"
                                                    placeholder="Enter Product Price" name="price" required>
                                                <label>Product Image</label>
                                                <div
                                                    class="input-group uploadDiv mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">

                                                    <input id="upload" type="file" onchange="readURL(this);"
                                                        class="form-control border-0 d-none" name="image">
                                                    <label id="upload-label" for="upload"
                                                        class="font-weight-light text-muted m-2" required>Upload
                                                        image</label>
                                                    <div class="input-group-append">
                                                        <label for="upload"
                                                            class="btn ButtonUpload text-white m-0 rounded-pill px-4"><small
                                                                class="text-uppercase font-weight-bold text-muted text-white">Choose
                                                                file</small></label>
                                                    </div>
                                                </div>
                                                <div class="image-area mt-4"><img id="imageResult" src="#"
                                                        alt=""
                                                        class="img-fluid rounded shadow-sm mx-auto d-block w-50"></div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" id="submit"
                                                        class="btn btn-primary btn-lg m-3"> Save Product </button>
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
            var form = '#add-user-form';
            var catValue = $('.Pizzacat').addClass("d-none");
            $(form).on('submit', function(event) {
                event.preventDefault();

                var url = $(this).attr('data-action');

                $.ajax({
                    url: 'http://esan.megaenterprisegroup.com/pizzaAdmin/api/add-product',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            showSuccessAlert()
                            window.location.href =
                                "http://esan.megaenterprisegroup.com/pizzaAdmin/menu";
                        }
                    },
                    error: function(response) {}
                });
            });

            function showSuccessAlert() {
                Swal.fire(
                    'Good job!',
                    'Product added SuccessFully!',
                    'success'
                )
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                console.log(input)
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
