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
                    <div class="col-2"></div>

                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center breadColor">Sauces</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.NO</th>
                                                <th scope="col">Name</th>
                                                <th scope="col"> Price</th>
                                                <th>Picture</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sauce_list">
                                            <tr>
                                                <td> White Sauce</td>
                                                </td>
                                                <td>$4.4</td>
                                                <td class="d-flex justify-content-center"><img class="w-50 rounded"
                                                        src="../../assets/images/menu/menu4.png"></td>
                                                <td>
                                                    <span>
                                                        <a href="javascript:void()" class="mr-4" data-toggle="tooltip"
                                                            data-placement="top" title="Edit"><i
                                                                class="bi bi-pen color-muted"></i> </a>
                                                        <a href="javascript:void()" data-toggle="tooltip"
                                                            data-placement="top" title="Close"><i
                                                                class="bi bi-trash color-danger"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
</body>
<script>
    var delete_employee;

    $(document).ready(function() {
        veiwSauces();
    });

    function veiwSauces() {
        var $list = $("#sauce_list");
        $list.empty();

        $.ajax({
            url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-sauce",
            type: "GET",
            success: function(data) {
                var count = 1;
                if (data.status == "success") {
                    $.each(data.data, function(index, obj) {
                        $list.append('<tr>' +
                            '<td>' + count + '</td>' +
                            '<td class="text-capitalize">' + obj.name + '</td>' +
                            '<td>' + obj.price + '</td>' +
                            '<td class="ImgContainer"><img class="w-100 rounded" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                            obj.image + '"></td>' +
                            '<td>' +
                            '<span>' +
                            '<a id="' + obj.id +
                            '" onclick="editCategory(this.id)" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pen text-warning"></i> </a>' +
                            '<a id="' + obj.id +
                            '" onclick="deleteCategory(this.id)" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash text-danger"></i></a>' +
                            '</span>' +
                            '</td>' +
                            '</tr>');
                        count++;
                    });
                } else {
                    swal_btn.click();
                }
            },
            error: function(data) {}
        });
    }
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })


    function fireSweetAlert() {
        Swal.fire(
            'Deleted successfully!',
            'Item have been deleted!',
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

    function deleteCategory(id) {
        var delete_id = id;
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/delete-sauce/${delete_id}`,
                    type: "get",
                    success: function(response) {
                        if (response.status == "success") {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            veiwSauces();
                        } else {
                            showError();

                        }
                    },
                    error: function(response) {
                        showError();
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })


    }

    function editCategory(id) {
        var emp_id = id;
        localStorage.setItem("emp_id", emp_id);
        window.location.href = "http://esan.megaenterprisegroup.com/pizzaAdmin/edit-sauce";

    }
</script>

</html>
