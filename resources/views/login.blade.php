<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pizza Admin Panel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images1/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-md-5">
                    <div class="form-input-content">
                        <div class="card card-login">
                            <div class="text-center my-3">
                                <img class="" src="{{ asset('/assets/images1/avatar/logo.png') }}" width="100"
                                    height="100" alt="">
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/pizza-admin/login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control rounded-0 bg-transparent"
                                            placeholder="Username" name="email">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control rounded-0 bg-transparent"
                                            placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group ml-3 mb-5">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="label-checkbox ml-2 mb-0" for="checkbox1">Remember
                                            Password</label>
                                    </div>
                                    <button class="btn btn-danger btn-block border-0" type="submit">Login</button>
                                </form>
                            </div>
                            <div class="card-footer text-center border-0 pt-0">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="{{ asset('/assets/plugins/common/common.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/c241896c98.js" crossorigin="anonymous"></script>
    <!-- Custom script -->
    <script src="{{ asset('/js/custom.min.js') }}"></script>
    <script src="{{ asset('/js/settings.js') }}"></script>
    <script src="{{ asset('/js/quixnav.js') }}"></script>
</body>


</html>
