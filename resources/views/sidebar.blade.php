<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="nk-sidebar" id="sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow">

                </button>

                <ul aria-expanded="false">
                    <li class="text-danger ml-5 p-1"><a href=""></a><i class="bi bi-house-door-fill icon_side"
                            style="color: #E53935;"></i> Dashboard</li>
                    <li>

                        <a class="has-arrow" href="javascript:void()" aria-expanded="false"> <i
                                class="bi bi-cart3 icon_side" style="color: #E53935;"></i> <span
                                class="fs-2">Product</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('home') }}">Veiw Product</a></li>
                            <li><a href="{{ url('/pizza-admin/add-menu-item') }}">Add Product</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ url('/pizza-admin/add-pizza') }}">
                            <i class="bi bi-cart-plus  icon_side" style="color: #E53935;"></i> Add Pizza</a></li>
                    <li><a class="" href="{{ url('/pizza-admin/build-your-own') }}" aria-expanded="false"><i
                                class="bi bi-plus-circle-fill icon_side" style="color: #E53935;"></i>Build Your
                            Pizza</a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-diagram-3-fill icon_side" style="color: #E53935;"></i> Category</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-category') }}">Veiw Category</a></li>
                            <li><a href="{{ url('/add-category') }}">Add Category</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"> <i
                                class="bi bi-bar-chart-steps icon_side" style="color: #E53935;"></i>Toppings</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-toppings') }}">Veiw Toppings</a></li>
                            <li><a href="{{ url('/add-toppings') }}">Add Toppings</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"> <i
                                class="bi bi-layers-fill icon_side" style="color: #E53935;"></i>Sauces For Dipping</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-sauces') }}">Veiw Sauces</a></li>
                            <li><a href="{{ url('/add-sauces') }}">Add Sauce</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-x-diamond-fill icon_side" style="color: #E53935;"></i>Cheeses</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-cheese') }}">Veiw Cheese</a></li>
                            <li><a href="{{ url('/add-cheese') }}">Add Cheese</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"> <i
                                class="bi bi-vinyl-fill icon_side" style="color: #E53935;"></i>Crusts</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-crust') }}">Veiw Crust</a></li>
                            <li><a href="{{ url('/add-crust') }}">Add Crust</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-newspaper icon_side" style="color: #E53935;"></i>Coupons</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-coupons') }}">Veiw Coupons</a></li>
                            <li><a href="{{ url('/add-coupons') }}">Add Coupons</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-disc-fill icon_side" style="color: #E53935;"></i>Disc</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/view-disc') }}">Veiw Disc</a></li>
                            <li><a href="{{ url('/add-disc') }}">Add Disc</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-diagram-2-fill icon_side" style="color: #E53935;"></i>Pizza Category</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ url('/pizza-category') }}">Veiw Pizza Category</a></li>
                            <li><a href="{{ url('/add-pizza-category') }}">Add Pizza Category</a></li>
                        </ul>
                    </li>
                </ul>
        </div>

    </div>
    <script src="https://kit.fontawesome.com/c241896c98.js" crossorigin="anonymous"></script>
</body>

</html>
