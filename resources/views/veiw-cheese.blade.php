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

            <div class="container-fluid">

                <div class="row">
                    <div class="col-2"></div>

                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center breadColor">Cheese</h4>
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
                                        <tbody id="cheese_list">
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
        <script src="{{ asset('/assets/plugins/common/common.min.js') }}"></script>
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
        <script src="{{ asset('/js/plugins-init/jsgrid-init.js') }}"></script>
        <script src="{{ asset('/js/plugins-init/footable-init.js') }}"></script>
        <script src="{{ asset('/js/plugins-init/jquery.bootgrid-init.js') }}"></script>
        <script src="{{ asset('/js/plugins-init/datatables.init.js') }}"></script>
        <!-- switchery init-->

        <script>
            var delete_employee;

            $(document).ready(function() {
                viewCategories();

            });

            function viewCategories() {
                var $list = $("#cheese_list");
                $list.empty();

                $.ajax({
                    url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-cheese",
                    type: "GET",
                    success: function(data) {
                        var count = 1;
                        if (data.status == "success") {
                            $.each(data.data, function(index, obj) {
                                $list.append('<tr>' +
                                    '<td>' + count + '</td>' +
                                    '<td class="text-capitalize">' + obj.cheese_name + '</td>' +
                                    '<td>' + obj.cheese_price + '</td>' +
                                    '<td class="ImgContainer"><img class="w-100 rounded" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                                    obj.cheese_image + '"></td>' +
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
                            url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/delete-cheese/${delete_id}`,
                            type: "get",
                            success: function(response) {
                                if (response.status == "success") {
                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    viewCategories();
                                } else {
                                    showError()
                                }
                            },
                            error: function(data) {}
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
                window.location.href = "http://esan.megaenterprisegroup.com/pizzaAdmin/edit-cheese";

            }

            function statusChange(id) {
                var emp_id = id;
                $.ajax({
                    url: "kos_apis/active_employee.php",
                    type: "get",
                    data: {
                        "emp_username": emp_id
                    },
                    success: function(result) {
                        var data = jQuery.parseJSON(result);
                        if (data.status == "success") {
                            swal_btn3.click();
                            viewCategories();
                        } else if (data.status == "failed") {
                            alert("failed");
                        }
                    },
                    error: function(data) {}
                });
            }
        </script>
</body>


</html>
