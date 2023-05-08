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
    <link href="{{ asset('/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('sweetalert::alert')

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
        {{-- <div>
            {{ Breadcrumbs::render('home') }}
        </div> --}}
        <!-- row -->
        <!--**********************************
            Header start
        ***********************************-->

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('sidebar');
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">




            <div class="container-fluid">

                <div class="row">
                    @if (session()->has('message'))
                        <div class="alert alert-light d-flex align-items-center"
                            style=" width:100%    ; margin-left: 1%;
    margin-right: 1%;  ;background-color:dodgerblue; color:white">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    {{-- ///////////////////////////////////////////// --}}
                    <div class="main-search-input-wrap w-20 ">
                        <div class="main-search-input">
                            <form>
                                <div class="search-box">
                                    <input name="search" class="search-input" type="text"
                                        placeholder="Search something..">
                                    <button
                                        class="btn btn-danger d-flex flex-row inline-btn justify-content-center align-items-center"><i
                                            class="bi bi-search m-1"></i><span class="fs-6">Search
                                        </span> </button>
                                </div>
                            </form>
                            <a href="{{ route('toppings') }}">
                                <button class="btn btn-warning inline-btn" style="height: 54px;"> Add Topping
                                </button>
                            </a>
                        </div>

                    </div>
                    <div class="col-xl-10 col-xxl-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Toppings</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cheese Name</th>
                                                <th scope="col">Cheese Price</th>
                                                <th scope="col"> Cheese Price 18 </th>
                                                <th scope="col"> Sauce Name</th>
                                                <th scope="col"> Sauce Price 12</th>
                                                <th scope="col"> Sauce Price 18</th>
                                                <th scope="col"> Topping Name</th>
                                                <th scope="col"> Topping Price 12</th>
                                                <th scope="col"> Topping Price 18</th>
                                                <th scope="col"> Less price 12</th>
                                                <th scope="col"> Less price 18</th>
                                                <th scope="col"> Normal price 18</th>
                                                <th scope="col"> Normal price 12</th>
                                                <th scope="col"> Extra prize 12</th>
                                                <th scope="col"> Extra prize 18</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($get_topping as $data)
                                                <tr>
                                                    <td>{{ $data->cheese }}</td>
                                                    <td>{{ $data->cheese_price }}
                                                    </td>
                                                    <td>
                                                        {{ $data->cheese_price_18 }}
                                                    </td>
                                                    <td>{{ $data->sauce }}</td>
                                                    <td>
                                                        {{ $data->sauce_price }}
                                                    </td>

                                                    <td> {{ $data->sauce_price_18 }}
                                                    </td>
                                                    <td>
                                                        {{ $data->regular_toppings }}
                                                    </td>
                                                    <td>{{ $data->regular_topping_price }}
                                                    </td>
                                                    <td>{{ $data->regular_topping_price_18 }}
                                                    </td>
                                                    <td>{{ $data->less_price }}
                                                    </td>
                                                    <td>{{ $data->less_price_18 }}
                                                    </td>
                                                    <td>{{ $data->normal_price }}
                                                    </td>
                                                    <td>{{ $data->normal_price_18 }}
                                                    </td>
                                                    <td>{{ $data->extra_price }}
                                                    </td>
                                                    <td>{{ $data->extra_price_18 }}
                                                    </td>
                                                    <td>
                                                        <form method="GET"
                                                            action="{{ url('/pizza-admin/delete-toppings', ['id' => $data->id]) }}">
                                                            @csrf
                                                            <input name="method" type="hidden" value="DELETE">
                                                            <button type="submit"
                                                                class="btn show_confirm"data-toggle="tooltip"
                                                                title='Delete'><i
                                                                    class="bi bi-trash color-danger"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center " style="margin-left: 20%">
                    {!! $get_topping->links() !!}
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
        <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
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
        <script src="{{ asset('js/plugins-init/jsgrid-init.js') }}"></script>
        <script src="{{ asset('js/plugins-init/footable-init.js') }}"></script>
        <script src="{{ asset('js/plugins-init/jquery.bootgrid-init.js') }}"></script>
        <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
        <!-- switchery init-->
        <script src="{{ asset('js/plugins-init/switchery-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });
        </script>
</body>


</html>
