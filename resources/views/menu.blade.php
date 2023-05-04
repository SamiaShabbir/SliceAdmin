<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>pizza admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public//assets/images/favicon.png') }}">
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
        <!-- row -->

        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-2"></div>
                <div class="col-10 ">
                    <h2 class="page-heading text-center m-2 fs-5 fw-bold">Hi,Welcome Back!</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Menu List</h4>
                            <div class="tab d-flex justify-content-around">
                                <button class="tablinks active" onclick="openCity(event, 'Pizza')">Pizza</button>
                                <button class="tablinks" onclick="openCity(event, 'Drinks')">Drinks</button>
                                <button class="tablinks" onclick="openCity(event, 'Desserts')">Desserts</button>
                            </div>

                            <!-- Tab content -->
                            <div id="Pizza" class="tabcontent active">
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.no</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Pizza Category</th>
                                                <th scope="col">12" Price</th>
                                                <th scope="col">18" Price</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tableContainer" id="product_list">
                                            <tr id="product_id">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="badge badge-primary">Sale</span>
                                                <td class="d-flex justify-content-center align-items-center"><img
                                                        class="w-50 rounded" src=${product.image}></td>

                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="Drinks" class="tabcontent h-100">
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.no</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tableContainer" id="drink_list">
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="Desserts" class="tabcontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.no</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col"> Price</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tableContainer" id="dessert_list">
                                            <tr id="">

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
    <script src="{{ asset('public/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/js/settings.js') }}"></script>
    <script src="{{ asset('public/js/quixnav.js') }}"></script>
    <script src="{{ asset('public/js/styleSwitcher.js') }}"></script>
    <!-- switchery -->
    <script src="{{ asset('public/assets/plugins/innoto-switchery/dist/switchery.min.js') }}"></script>
    <!-- JS Grid -->
    <script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jsgrid/js/jsgrid.min.js') }}"></script>
    <!-- JS GRID INTI -->
    <script src="{{ asset('public/js/plugins-init/jsgrid-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/footable-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/jquery.bootgrid-init.js') }}"></script>
    <script src="{{ asset('public/js/plugins-init/datatables.init.js') }}"></script>
    <!-- switchery init-->

    <script>
        var delete_employee;

        $(document).ready(function() {
            veiwProduct();
            veiwDesserts();
            veiwDrinks();
            // Set default active tab

            document.getElementsByClassName("tablinks active")[0].className += " active";
            document.getElementsByClassName("tabcontent active")[0].style.display = "block";
            //Active Row
        });

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

        function veiwProduct() {
            var $list = $("#product_list");
            $list.empty();

            $.ajax({
                url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-pizza",
                type: "GET",
                success: function(data) {
                    var count = 1;
                    if (data.status == "success") {
                        $.each(data.data.pizza, function(index, obj) {
                            $list.append('<tr>' +
                                '<td>' + count + '</td>' +
                                '<td class="text-capitalize">' + obj.name + '</td>' +
                                '<td>' + obj.sub_cat_name + '</td>' +
                                '<td>' + obj.price1 + '</td>' +
                                '<td>' + obj.price2 + '</td>' +
                                '<td class="text-capitalize">' + obj.description + '</td>' +
                                '<td class="ImgContainer "><img class="w-75" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                                obj.image + '"></td>' +
                                '<td>' +
                                '<span>' +
                                '<a id="' + obj.id +
                                '" onclick="deletePizza(this.id)" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash text-danger"></i></a>' +
                                '</span>' +
                                '</td>' +
                                '</tr>');
                            count++;
                        });
                    } else {

                    }
                },
                error: function(data) {}
            });
        }

        function veiwDrinks() {
            var $list = $("#drink_list");
            $list.empty();

            $.ajax({
                url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-pizza",
                type: "GET",
                success: function(data) {
                    var count = 1;
                    if (data.status == "success") {
                        $.each(data.data.Drink, function(index, obj) {
                            $list.append('<tr>' +
                                '<td>' + count + '</td>' +
                                '<td class="text-capitalize">' + obj.name + '</td>' +
                                '<td>' + obj.cat_name + '</td>' +
                                '<td>' + obj.price1 + '</td>' +
                                '<td class="text-capitalize">' + obj.description + '</td>' +
                                '<td class="ImgContainer "><img class="w-75" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                                obj.image + '"></td>' +
                                '<td>' +
                                '<span>' +
                                '<a id="' + obj.id +
                                '" onclick="editProduct(this.id)" class="mr-4 w-100" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pen text-warning fs-1"></i> </a>' +
                                '<a id="' + obj.id +
                                '" onclick="deleteProduct(this.id)" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash text-danger"></i></a>' +
                                '</span>' +
                                '</td>' +
                                '</tr>');
                            count++;
                        });
                    } else {

                    }
                },
                error: function(data) {}
            });
        }

        function veiwDesserts() {
            var $list = $("#dessert_list");
            $list.empty();

            $.ajax({
                url: "http://esan.megaenterprisegroup.com/pizzaAdmin/api/get-pizza",
                type: "GET",
                success: function(data) {
                    var count = 1;
                    if (data.status == "success") {
                        $.each(data.data.Dessert, function(index, obj) {
                            $list.append('<tr>' +
                                '<td>' + count + '</td>' +
                                '<td class="text-capitalize">' + obj.name + '</td>' +
                                '<td>' + obj.cat_name + '</td>' +
                                '<td>' + obj.price1 + '</td>' +
                                '<td class="text-capitalize">' + obj.description + '</td>' +
                                '<td class="ImgContainer "><img class="w-75" src="http://esan.megaenterprisegroup.com/pizzaAdmin/public/images/' +
                                obj.image + '"></td>' +
                                '<td>' +
                                '<span>' +
                                '<a id="' + obj.id +
                                '" onclick="editProduct(this.id)" class="mr-4 w-100" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pen text-warning fs-1"></i> </a>' +
                                '<a id="' + obj.id +
                                '" onclick="deleteProduct(this.id)" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash text-danger"></i></a>' +
                                '</span>' +
                                '</td>' +
                                '</tr>');
                            count++;
                        });
                    } else {

                    }
                },
                error: function(data) {}
            });
        }

        function deletePizza(id) {
            var delete_id = id;
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
                    $.ajax({
                        url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/delete-pizza/${delete_id}`,
                        type: "get",
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            veiwProduct();

                        },
                    });

                }
            })


        }

        function deleteProduct(id) {
            var delete_id = id;
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
                    $.ajax({
                        url: `http://esan.megaenterprisegroup.com/pizzaAdmin/api/delete-product/${delete_id}`,
                        type: "get",
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            veiwDesserts();
                            veiwDrinks()

                        },
                    });

                }
            })


        }
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        function openCity(evt, category) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(category).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function editProduct(id) {
            var emp_id = id;
            localStorage.setItem("emp_id", emp_id);
            window.location.href = `http://esan.megaenterprisegroup.com/pizzaAdmin/edit-product`;

        }
    </script>
</body>


</html>
