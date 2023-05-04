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
            @if (session()->has('message'))
                <div class="alert alert-light d-flex align-items-center" style="color: black ">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="container-fluid">
                <div class="row justify-content-between mb-3">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <h2 class="page-heading">Hi,Welcome Back!</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="addProductWrapper">

                        <div class="row d-flex justify-content-center flex-column align-items-center">
                            <h4>Edit Category</h4>
                            <div class="col-lg-10 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                                <div class="basic-form">
                                    <form id="add-user-form">
                                        @csrf
                                        <div id="edit_category">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-lg m-3"> Save Product
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
</body>
<script>
    $(document).ready(function() {
        let edit_id = localStorage.getItem("emp_id");
        // alert(edit_id);
        veiwProduct()
        var form = '#add-user-form';

        function veiwProduct() {

            var $list = $("#edit_category");
            // const params = new URLSearchParams(edit_id);
            // alert(edit_id)
            $.ajax({
                url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-category/${edit_id}`,
                type: "GET",
                success: function(data) {
                    var count = 1;
                    if (data.status == "success") {
                        $.each(data.data, function(index, obj) {
                            console.log(obj.id)
                            $list.append(
                                ' <div class="form-group">' +
                                ' <input class="form-control mb-2" id="name"  value="' +
                                obj.name + '" type="text"  name="name"required>' +
                                ' <h4 class="card-title mt-5">Description</h4>' +
                                '<div class="basic-form">' +
                                '<div class="form-group">' +
                                ' <textarea  class="form-control" value="' + obj.desc +
                                '" rows="3" id="desc" name="description" required>' +
                                obj.desc + '</textarea>' +
                                '</div>' +
                                '</div>' +
                                '<div class="form-group">' +

                                '</div>' +
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

                    }
                },
                error: function(data) {}
            });
        }

        $("#add-user-form").on('submit', function(event) {
            event.preventDefault();

            var url = $(this).attr('data');

            $.ajax({
                url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/edit-category/${edit_id}`,
                method: 'POST',
                data: new FormData(this),
                dataType: 'html',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    fireSweetAlert();
                    window.location.href =
                        "http://esan.megaenterprisegroup.com/pizzaAdmin/view-category";
                },
                error: function(response) {
                    showError();
                }
            });
        });

    });

    function fireSweetAlert() {
        Swal.fire(
            'Good Job!',
            'Item have been Updated!',
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

</html>
