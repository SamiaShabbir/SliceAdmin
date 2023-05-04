<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
</head>
<body>
<div class="nk-sidebar" id="sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                     <ul aria-expanded="false">
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Product</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/menu')}}">Veiw Product</a></li>
                                <li><a href="{{url('/pizza-admin/add-menu-item')}}">Add Product</a></li>
                            </ul>
                        </li>
                                <li><a href="{{url('/pizza-admin/add-pizza')}}">Add Pizza</a></li>     
                        <li><a class="" href="{{url('/pizza-admin/build-your-own')}}" aria-expanded="false">Build Your Own Pizza</a>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Category</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-category')}}">Veiw Category</a></li>
                                <li><a href="{{url('/add-category')}}">Add Category</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Toppings</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-toppings')}}">Veiw Toppings</a></li>
                                <li><a href="{{url('/add-toppings')}}">Add Toppings</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sauces For Dipping</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-sauces')}}">Veiw Sauces</a></li>
                                <li><a href="{{url('/add-sauces')}}">Add Sauce</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cheeses</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-cheese')}}">Veiw Cheese</a></li>
                                <li><a href="{{url('/add-cheese')}}">Add Cheese</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Crusts</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-crust')}}">Veiw Crust</a></li>
                                <li><a href="{{url('/add-crust')}}">Add Crust</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Coupons</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-coupons')}}">Veiw Coupons</a></li>
                                <li><a href="{{url('/add-coupons')}}">Add Coupons</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Disc</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/view-disc')}}">Veiw Disc</a></li>
                                <li><a href="{{url('/add-disc')}}">Add Disc</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Pizza Category</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/pizza-category')}}">Veiw Pizza Category</a></li>
                                <li><a href="{{url('/add-pizza-category')}}">Add Pizza Category</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
          
        </div>
        
        <script>
    // Get all dropdown menu items
    var dropdowns = document.querySelectorAll('.has-arrow');

    // Loop through the dropdowns
    for (var i = 0; i < dropdowns.length; i++) {
        // Add a click event listener to each dropdown
        dropdowns[i].addEventListener('click', function() {
            // Toggle the 'active' class on the parent li element
            this.parentElement.classList.toggle('active');
            // Toggle the 'show' class on the child ul element
            var dropdown = this.nextElementSibling;
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            } else {
                dropdown.classList.add('show');
            }
        });
    }

    // Get the sidebar collapse button
    var sidebarCollapse = document.querySelector('#sidebarCollapse');

    // Add a click event listener to the sidebar collapse button
    sidebarCollapse.addEventListener('click', function() {
        // Toggle the 'active' class on the sidebar
        document.querySelector('#sidebar').classList.toggle('active');
    });
</script>

</body>
</html>
       