<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProduct;
use App\Http\Controllers\AdminCategory;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/menu', function () {
    return view('menu');
})->name('home');
Route::get('/veiw-pizza', function () {
    return view('veiw-pizza');
});
Route::get('/add-category', function () {
    $parentCategories = \DB::table('categories')->where('parent_id', 0)->orderBy('name', 'ASC')->get();
    return view('add-category', compact(['parentCategories']));
});
Route::get('/add-cheese', function () {
    return view('add-cheese');
});
Route::get('/add-coupons', function () {
    return view('add-coupons');
});
Route::get('/add-disc', function () {
    return view('add-disc');
});
Route::get('/add-manager', function () {
    return view('add-manager');
});
Route::get('/add-crust', function () {
    return view('add-crust');
});
Route::get('/add-sauces', function () {
    return view('add-sauces');
});

Route::get('/add-toppings', function () {
    return view('add-topping');
})->name('toppings');

Route::get('/edit-product', function () {
    return view('edit-product');
});
Route::get('/edit-category', function () {
    return view('edit-category');
});
Route::get('/edit-sauce', function () {
    return view('edit-sauce');
});
Route::get('/edit-pizza', function () {
    return view('edit-pizza');
});
Route::get('/edit-cheese', function () {
    return view('edit-cheese');
});
Route::get('/edit-coupons', function () {
    return view('edit-coupons');
});
Route::get('/edit-disc', function () {
    return view('edit-disc');
});
Route::get('/edit-manager', function () {
    return view('edit-manager');
});
Route::get('/edit-crust', function () {
    return view('edit-crust');
});
Route::get('/edit-toppings', function () {
    return view('edit-toppings');
});
Route::get('/forms', function () {
    return view('forms');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/table', function () {
    return view('tables');
});
Route::get('/view-category', function () {
    return view('veiw-category');
});
Route::get('/pizza-category', function () {
    return view('pizza-category');
});
Route::get('/add-pizza-category', function () {
    return view('add-pizza-category');
});
Route::get('/edit-pizza-category', function () {
    return view('edit-pizza-category');
});
Route::get('/view-manager', function () {
    return view('veiw-manager');
});
Route::get('/view-disc', function () {
    return view('view-disc');
});
Route::get('/view-coupons', function () {
    return view('veiw-coupons');
});
Route::get('/view-cheese', function () {
    return view('veiw-cheese');
});
Route::get('/view-crust', function () {
    return view('veiw-crust');
});
Route::get('/view-sauces', function () {
    return view('veiw-sauces');
});
Route::get('/view-toppings', function () {
    return view('veiw-toppings');
})->name('getTopping');
Route::get('/view-widget', function () {
    return view('widget-basic');
});
Route::get('/csrf-token', function () {
    $token = csrf_token();
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::group(['prefix' => 'pizza-admin'], function () {
    Route::post('/add-product', [AdminProduct::class, 'store']);
    Route::get('/add-menu-item', [AdminProduct::class, 'getCategory']);
    Route::get('/edit-product', [AdminProduct::class, 'geteditCategory']);
    Route::get('/edit-product/{id}', [AdminProduct::class, 'getEditProductById']);
    Route::get('/get-product', [AdminProduct::class, 'View']);
    Route::post('/add-cheese', [AdminProduct::class, 'addCheese']);
    Route::post('/edit-product/{id}', [AdminProduct::class, 'updateProduct']);
    Route::post('/add-dipping-sauce', [AdminProduct::class, 'addDippingSauce']);
    Route::post('/add-category', [AdminCategory::class, 'addCategory']);
    Route::get('/get-category', [AdminCategory::class, 'ViewCategory']);
    Route::get('/get-sauce', [AdminProduct::class, 'getsauce']);
    Route::get('/get-toppings', [AdminProduct::class, 'GetTopping']);
    Route::get('/delete-category/{id}', [AdminProduct::class, 'deleteCategory']);
    Route::get('/delete-product/{id}', [AdminProduct::class, 'deleteProduct']);
    Route::get('/delete-sauce/{id}', [AdminProduct::class, 'deleteSauce']);
    Route::post('/edit-sauce/{id}', [AdminProduct::class, 'EditD_sauce']);
    Route::post('/add-toppings', [AdminProduct::class, 'AddToppings']);
    Route::post('/edit-category/{id}', [AdminCategory::class, 'Edit_Category']);
    Route::post('/edit-toppings/{id}', [AdminProduct::class, 'editToppings']);
    Route::get('/edit-category/{id}', [AdminProduct::class, 'getCatByid']);
    Route::get('/edit-topping/{id}', [AdminProduct::class, 'getToppingByid']);
    Route::get('/edit-sauce/{id}', [AdminProduct::class, 'getSauceByid']);
    Route::post('/edit-cheese/{id}', [AdminProduct::class, 'EditCheese']);
    Route::post('/add-cheese', [AdminProduct::class, 'AddCheese']);
    Route::get('/get-cheese', [AdminProduct::class, 'getCheese']);
    Route::get('/delete-cheese/{id}', [AdminProduct::class, 'DeleteCheese']);
    Route::get('/get-cheese-byId/{id}', [AdminProduct::class, 'getCheeseByid']);
    Route::post('/add-crust', [AdminProduct::class, 'addcrust']);
    Route::post('/edit-crust/{id}', [AdminProduct::class, 'editCrust']);
    Route::get('/get-crust', [AdminProduct::class, 'Getcrust']);
    Route::get('/get-crust-by-id/{id}', [AdminProduct::class, 'getCrustByid']);
    Route::get('/delete-toppings/{id}', [AdminProduct::class, 'deletetopping']);
    Route::get('/delete-crust/{id}', [AdminProduct::class, 'DeleteCrust']);
    Route::post('/add-pizza', [AdminProduct::class, 'addSpecialPizza']);
    Route::get('/add-pizza', [AdminProduct::class, 'getCategoryForPizza']);
    //////////////////////////////////////////////////////////////////////////////////////
    Route::post('/edit-pizza/{id}', [AdminProduct::class, 'editPizza']);
    Route::get('/edit-pizza/{id}', [AdminProduct::class, 'getEditPizza']);

    Route::get('/get-pizza', [AdminProduct::class, 'getSpecialPizza']);
    Route::get('/delete-pizza/{id}', [AdminProduct::class, 'deleteSpecialPizza']);

    Route::post('/build-your-own', [AdminProduct::class, 'BuildYourOwn']);
    Route::post('/delete-your-own', [AdminProduct::class, 'delete_your_Pizza']);
    Route::post('edit-your-own', [AdminProduct::class, 'editYour_own_Pizza']);
    Route::get('get-your-own/{id}', [AdminProduct::class, 'getEditdata']);
    Route::post('edit-build-pizza/{id}', [AdminProduct::class, 'edit_your_own_pizza']);

    Route::post('get-edit-build-pizza', [DriverController::class, 'getEditdata']);
    ///// pages
    Route::get('build-your-own', [AdminProduct::class, 'addhalf_build_pizza']);
    Route::get('edit-own-pizza', [AdminProduct::class, 'EditOWn_get']);
    Route::get('view-own-pizza', [AdminProduct::class, 'get_own_piza']);

    // coupons api
    Route::post('/add-coupons', [AdminCategory::class, 'Addcoupon']);
    Route::get('/delete-coupons/{id}', [AdminCategory::class, 'DeleteCoupon']);
    Route::get('/get-coupons', [AdminCategory::class, 'getCoupons']);
    Route::get('/edit-coupons/{id}', [AdminCategory::class, 'GetEditCoupons']);
    Route::post('/edit-coupons/{id}', [AdminCategory::class, 'EditCoupon']);
    // dessert api
    Route::get('/get-dessert', [AdminCategory::class, 'getDessert']);
    // get drink api
    Route::get('/get-drink', [AdminCategory::class, 'getDrinks']);
    // disc api
    Route::post('/add-disc', [AdminCategory::class, 'AddDisc']);
    Route::get('/get-disc', [AdminCategory::class, 'getDisc']);
    Route::get('/remove-disc/{id}', [AdminCategory::class, 'RemoveDisc']);
    // add sub category
    Route::post('/add-sub-category', [AdminCategory::class, 'Addsubcategory']);
    Route::get('/get-sub-category', [AdminCategory::class, 'getsubCategory']);
    Route::get('/delete-sub-category/{id}', [AdminCategory::class, 'deletesubCategory']);
    Route::get('/edit-sub-category/{id}', [AdminCategory::class, 'GeteditsubCategory']);
    Route::post('/edit-sub-category/{id}', [AdminCategory::class, 'editsubCategory']);

    Route::get('/get-sub-category', [AdminProduct::class, 'getCategoryForPizza']);

    ////////////////special pizza api

    // Route::post('/add-special-pizza',[AdminProduct::class,'addSpecialPizza']);
    // Route::post('/edit-special-pizza/{id}',[AdminProduct::class,'editSpecailPizza']);
    // Route::get('/get-special=pizza',[AdminProduct::class,'getSpecialPizza']);
    // Route::get('/dalete-special-pizza/{id}',[AdminProduct::class,'deleteSpecialPizza']);

});
