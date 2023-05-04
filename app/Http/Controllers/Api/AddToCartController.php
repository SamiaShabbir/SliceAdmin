<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\AddToCart;
use App\Models\Api\Product;
use App\Models\Api\User;
use App\Models\Api\multiple_tooping;
use Validator;
use DB;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;


class AddToCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->query('phone_no')) {
                $user = User::where('phone', $request->query('phone_no'))->pluck('id');
                $data = AddToCart::with('product')->where('user_id', $user)->orderBy('created_at', 'desc')->get();
                return response()->json(['status' => 'success', 'data' => $data]);
            } else {
                $data = AddToCart::with('product')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
                return response()->json(['status' => 'success', 'data' => $data]);
            }
        } catch (\Throwable $th) {

            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request,  AddToCart $addToCart)
    // {
    //     //validate incoming request
    //     $validator = Validator::make($request->all(), [
    //         'product_id' => 'required',
    //         'quantity' => 'required|max:12',
    //         'size' => 'required|max:50',
    //         'price' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
    //     } else {

    //         try {
    //             $product = Product::find($request->product_id);
    //             $checkCartEmpty = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 0])->get();
    //             $checkCartEmpty1 = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 1])->get();
    //             if (count($checkCartEmpty1) >= 1 || count($checkCartEmpty1) == 0) {
    //                 if (!empty($product)) {

    //                         $addToCart->create([
    //                             'user_id' => auth()->user()->id,
    //                             'product_id' => $request->product_id,
    //                             'pizza_name' => $request->pizza_name,
    //                             'pizza_image' => $request->pizza_image,
    //                             'quantity' => $request->quantity,
    //                             'size' => $request->size,
    //                             'price' => $request->price,
    //                             'drinks' => $request->drinks,
    //                             'drink_size' => $request->drink_size,
    //                             'drink_quantity' => $request->drink_quantity,
    //                             'drink_price' => $request->drink_price,
    //                             'cheese_pizza_side' => $request->cheese_pizza_side,
    //                             'topping_pizza_side' => $request->topping_pizza_side,
    //                             'topping_type' => $request->topping_type,
    //                             'cheese' => $request->cheese,
    //                             'cheese_price' => $request->cheese_price,
    //                             'sauce' => $request->sauce,
    //                             'sauce_price' => $request->sauce_price,
    //                             'regular_toppings' => $request->regular_toppings,
    //                             'regular_topping_price' => $request->regular_topping_price,
    //                             'extra_dressing' => $request->extra_dressing,
    //                             'ex_dressing_price' => $request->ex_dressing_price,
    //                             'appitizer' => $request->appitizer,
    //                             'appitizer_price' =>$request->appitizer_price,
    //                             'dipping_name' =>$request->dipping_name,
    //                             'dipping_price' =>$request->dipping_price,
    //                             'dipping_quantity'=>$request->dipping_quantity,
    //                         ]);
    //                         $product->update([
    //                             'quntity' => $request->quantity
    //                         ]);
    //                         return response()->json(['status' => 'success', 'msg' => "Product Add in a cart Successfully!!"]);

    //                 } else {
    //                     return response()->json(['status' => 'failed', 'msg' => "Product not available"]);
    //                 }
    //             }
    //         } catch (\Throwable $th) {
    //             return response()->json(['status' => 'failed', 'msg' => "error adding"]);
    //         }
    //     }
    // }


    public function store(Request $request,  AddToCart $addToCart)
    {
        //validate incoming request
        /*
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|max:12',
            'size' => 'required|max:50',
            'price' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        }
        */

        if (1 == 2) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {

            // try {
            if (isset($request['type']) && !empty($request['type']) && in_array($request['type'], [1])) {
                $product = DB::table("cold_drinks")->where("id", $request->product_id)->first();
            } elseif (isset($request['type']) && !empty($request['type']) && in_array($request['type'], [2])) {
                $product = DB::table("deserts")->where("id", $request->product_id)->first();
            } else {
                $product = Product::find($request->product_id);
            }

            // $product = DB::table('s_pizza')->where('id',$request->product_id);
            // if(isset($request['type']) && !empty($request['type']) && in_array($request['type'], [1, 2])){
            //     AddToCart::where(['user_id' => auth()->user()->id])->delete();
            // }

            $checkCartEmpty = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 0, 'user_id' => auth()->user()->id])->get();
            $checkCartEmpty1 = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 1, 'user_id' => auth()->user()->id])->get();
            if (count($checkCartEmpty1) >= 1 || count($checkCartEmpty1) == 0) {
                if (!empty($product)) {

                    $addToCart = new AddToCart([
                        'user_id' => auth()->user()->id,
                        'product_id' => $request->product_id,
                        'pizza_name' => $request->pizza_name,
                        'pizza_image' => $request->pizza_image,
                        'quantity' => $request->quantity ?? "0",
                        'size' => $request->size ?? "",
                        'price' => $request->price ?? 0,
                        'drinks' => $request->drinks ?? "",
                        'drink_size' => $request->drink_size ?? "",
                        'drink_quantity' => $request->drink_quantity ?? "0",
                        'drink_price' => $request->drink_price ?? "0",
                        'cheese_pizza_side' => $request->cheese_pizza_side ?? "",
                        'topping_pizza_side' => $request->topping_pizza_side ?? "",
                        'topping_type' => $request->topping_type ?? "",
                        'cheese' => $request->cheese ?? "",
                        'cheese_price' => $request->cheese_price ?? 0,
                        'sauce' => $request->sauce ?? "",
                        'sauce_price' => $request->sauce_price ?? 0,
                        'regular_toppings' => $request->regular_toppings ?? "",
                        'regular_topping_price' => $request->regular_topping_price ?? "0",
                        'extra_dressing' => $request->extra_dressing ?? "",
                        'ex_dressing_price' => $request->ex_dressing_price ?? "0",
                        'appitizer' => $request->appitizer ?? "",
                        'appitizer_price' => $request->appitizer_price ?? "0",
                        'dipping_name' => $request->dipping_name ?? "",
                        'dipping_price' => $request->dipping_price ?? "0",
                        'desserts_name' => $request->desserts_name ?? "",
                        'desserts_price' => $request->desserts_price ?? 0,
                        'desserts_quantity' => $request->desserts_quantity ?? 0,
                        'type' => $request->type ?? 0,
                        'drinks_json' => $request->drinks_json ?? "",
                    ]);
                    $addToCart->save();

                    $id = $addToCart->id;

                    $value1 = explode(',', $request->topping_type);
                    $value2 = explode(',', $request->regular_toppings);
                    // $params = $request->topping_type . ',' . $request->regular_toppings;
                    // $values = explode(',', $params);
                    // $mergedValues = array_unique(array_merge($value1, $value2));
                    foreach ($value1 as $value) {

                        $table2 = multiple_tooping::create([
                            'add_to_carts_id' => $id,
                            'topping_type' => $value,
                            'topping_pizza_side' => $request->topping_pizza_side,
                            'regular_topping_price' => $request->regular_topping_price,
                        ]);
                    }


                    // Get the IDs of all existing records for the current add to cart ID
                    $table2 = multiple_tooping::where('add_to_carts_id', $id)->get(['id']);

                    foreach ($value2 as $index => $value23) {
                        // If the current index is less than the number of existing records,
                        // update the corresponding record with the current topping value
                        if ($index < count($table2)) {
                            $table2[$index]->regular_toppings = $value23;
                            $table2[$index]->save();
                        }
                        // If there are more toppings than existing records, create new records
                        else {
                            $table2 = multiple_tooping::create([
                                'add_to_carts_id' => $id,
                                'regular_toppings' => $value23,
                            ]);
                        }
                    }




                    // $product->update([
                    //     'quntity' => $request->quantity
                    // ]);
                    return response()->json(['status' => 'success', 'msg' => "Product Add in a cart Successfully!!"]);
                } else {
                    return response()->json(['status' => 'failed', 'msg' => "Product not available"]);
                }
                // }
                // } catch (\Throwable $th) {
                //     return response()->json(['status' => 'failed', 'msg' => "error adding"]);
                // }
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = AddToCart::with('product')->findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $addToCart = AddToCart::findOrFail($id);
            $product = Product::findOrFail($addToCart->product_id);
            $addToCart->update([
                'quantity' => $request->quantity,
                'size' => $request->size,
                'drinks' => $request->drinks
            ]);
            $product->update([
                'quntity' => $request->quantity
            ]);
            return response()->json(['status' => 'success', 'msg' => "Cart Quantity updated Successfully!!"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'msg' => "error updating!! no data found!!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addToCart = AddToCart::findOrFail($id);
        if ($addToCart->delete()) {
            Product::find($addToCart->product_id)->update(['quntity' => 'nil']);
            return response()->json(['status' => 'success', 'msg' => "Cart Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }
    public function showCartForApp(Request $request)
    {
        try {
            $data = AddToCart::with('product')->where('user_id', $request->query('userId'))->orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function deleteCart(Request $request)

    {
        if (isset($request['product_id']) && !empty($request['product_id']) and isset($request['user_id']) && !empty($request['user_id'])) {
            $product_id = $request['product_id'];
            $user_id = $request['user_id'];
            $type = $request['type'] ?? -1;

            $delete = DB::table('add_to_carts')->where('user_id', $user_id)->where('type', $type)->where('product_id', $product_id)->delete();

            return response()->json(['code' => 200, 'status' => "success", 'Cart deleted successfully!']);
        } else {
            return response()->json(['code' => 4001, 'status' => "success", 'incomplete param!']);
        }
    }

    public function deleteCartById(Request $request)
    {
        if (isset($request['product_id']) && !empty($request['product_id']) and isset($request['user_id']) && !empty($request['user_id'])) {
            $product_id = $request['product_id'];
            $user_id = $request['user_id'];

            $delete = DB::table('add_to_carts')->where('user_id', $user_id)->where('product_id', $product_id)->first();
            if ($delete != null) {
                $add_to_cart_id = $delete->id;
                $p_id = $delete->product_id;
                $u_id = $delete->user_id;
                $delete = DB::table('add_to_carts')->where('id', $add_to_cart_id)->where('user_id', $u_id)->where('product_id', $p_id)->delete();
                return response()->json(['code' => 200, 'status' => "success", 'Cart remove successfully!']);
            } else {
                return response()->json(['code' => 4001, 'status' => "success", 'product id not found!']);
            }
        } else {
            return response()->json(['code' => 4001, 'status' => "success", 'incomplete param!']);
        }
    }




    // add to cart ok code 4/8/2023

    //     public function store(Request $request,  AddToCart $addToCart)
    //     {
    //         //validate incoming request
    //         $validator = Validator::make($request->all(), [
    //             'product_id' => 'required',
    //             'quantity' => 'required|max:12',
    //             'size' => 'required|max:50',
    //             'price' => 'required'
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
    //         } else {

    //             // try {
    //                 $product = Product::find($request->product_id);
    //                 $checkCartEmpty = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 0])->get();
    //                 $checkCartEmpty1 = AddToCart::where(['product_id' => $request->product_id, 'add_cart_to_order_status' => 1])->get();
    //                 if (count($checkCartEmpty1) >= 1 || count($checkCartEmpty1) == 0) {
    //                     if (!empty($product)) {

    //                             $addToCart=new AddToCart([
    //                                 'user_id' => auth()->user()->id,
    //                                 'product_id' => $request->product_id,
    //                                 'pizza_name' => $request->pizza_name,
    //                                 'pizza_image' => $request->pizza_image,
    //                                 'quantity' => $request->quantity,
    //                                 'size' => $request->size,
    //                                 'price' => $request->price,
    //                                 'drinks' => $request->drinks,
    //                                 'drink_size' => $request->drink_size,
    //                                 'drink_quantity' => $request->drink_quantity,
    //                                 'drink_price' => $request->drink_price,
    //                                 'cheese_pizza_side' => $request->cheese_pizza_side,
    //                                 'topping_pizza_side' => $request->topping_pizza_side,
    //                                 'topping_type' => $request->topping_type,
    //                                 'cheese' => $request->cheese,
    //                                 'cheese_price' => $request->cheese_price,
    //                                 'sauce' => $request->sauce,
    //                                 'sauce_price' => $request->sauce_price,
    //                                 'regular_toppings' => $request->regular_toppings,
    //                                 'regular_topping_price' => $request->regular_topping_price,
    //                                 'extra_dressing' => $request->extra_dressing,
    //                                 'ex_dressing_price' => $request->ex_dressing_price,
    //                                 'appitizer' => $request->appitizer,
    //                                 'appitizer_price' =>$request->appitizer_price,
    //                                 'dipping_name' =>$request->dipping_name,
    //                                 'dipping_price' =>$request->dipping_price,
    //                                 'dipping_quantity'=>$request->dipping_quantity,
    //                             ]);
    //                             $addToCart->save();

    //                             $id = $addToCart->id;

    //                             $value1 = explode(',', $request->topping_type);
    //                             $value2 = explode(',', $request->regular_toppings);
    //                             // $params = $request->topping_type . ',' . $request->regular_toppings;
    //                             // $values = explode(',', $params);
    //                             // $mergedValues = array_unique(array_merge($value1, $value2));
    //                                 foreach ($value1 as $value) {

    //                                     $table2 = multiple_tooping::create([
    //                                         'add_to_carts_id' => $id,
    //                                         'topping_type' => $value,
    //                                         'topping_pizza_side' => $request->topping_pizza_side,
    //                                         'regular_topping_price' => $request->regular_topping_price,
    //                                     ]);

    //                                 }





    //                               // Get the IDs of all existing records for the current add to cart ID
    // $table2 = multiple_tooping::where('add_to_carts_id', $id)->get(['id']);

    // foreach ($value2 as $index => $value23) {
    //     // If the current index is less than the number of existing records,
    //     // update the corresponding record with the current topping value
    //     if ($index < count($table2)) {
    //         $table2[$index]->regular_toppings = $value23;
    //         $table2[$index]->save();
    //     }
    //     // If there are more toppings than existing records, create new records
    //     else {
    //         $table2 = multiple_tooping::create([
    //             'add_to_carts_id' => $id,
    //             'regular_toppings' => $value23,
    //         ]);
    //     }
    // }




    //                             $product->update([
    //                                 'quntity' => $request->quantity
    //                             ]);
    //                             return response()->json(['status' => 'success', 'msg' => "Product Add in a cart Successfully!!"]);

    //                     } else {
    //                         return response()->json(['status' => 'failed', 'msg' => "Product not available"]);
    //                     }
    //                 // }
    //             // } catch (\Throwable $th) {
    //             //     return response()->json(['status' => 'failed', 'msg' => "error adding"]);
    //             // }
    //         }
    //     }
    // }

}
