<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Http\Controllers\Controller;

class DriverController extends Controller
{

    public function GetorderDetail(Request $request)
    {
        if (isset($request['customer_no']) && !empty($request['customer_no'])) {
            $get_customer = DB::table('users')->where('phone', $request['customer_no'])->get('address');
            if ($get_customer) {
                $get_customer = DB::table('users')->where('phone', $request['customer_no'])->first();
                if ($get_customer) {
                    $no = $get_customer->phone;
                    $id = $get_customer->id;

                    $get_order = DB::table('add_to_carts')->where('user_id', $id)->get(['order_id', 'order_no']);
                    // dd($get_order);
                    $order_data = [];

                    if ($get_order->isNotEmpty()) {

                        foreach ($get_order as $order) {
                            $order_data[] = [
                                'id' => $order->order_id,
                                'order_no' => $order->order_no
                            ];
                        }

                        return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_customer, "order_data" => $order_data]);
                    } else {
                        //   echo "here";
                        return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_customer, "order_data" => $order_data]);
                    }
                }

                // return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_customer,"order_id"=> $getOrderId,"order_no"=>$getOrderNo]);
            } else {
                //   echo "here2";
                return response()->json(['status' => 'failed', 'message' => 'No data found']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Incomplete Param']);
        }
    }


    // public function GetorderDetail(Request $request)
    // {
    //     if (isset($request['customer_no']) && !empty($request['customer_no'])) {
    //         $get_customer = DB::table('users')->where('phone', $request['customer_no'])->get('address');
    //         if ($get_customer) {
    //             $get_customer = DB::table('users')->where('phone', $request['customer_no'])->first();
    //             if ($get_customer) {
    //                 $no = $get_customer->phone;
    //                 $id = $get_customer->id;

    //                 $get_order = DB::table('orders')->where('user_id', $id)->where('order_in_driver',null)

    //                     ->get(['id','order_no']);
    //                     // dd($get_order);

    //                     if($get_order->isNotEmpty())
    //                     {

    //                 foreach ($get_order as $order_id) {
    //                     $getOrderId = $order_id->id;
    //                     $getOrderNo = $order_id->order_no;
    //                     // dd($getOrderId);
    //                     $checkOrder = DB::table('driver')->where('order_id',$getOrderId)->get();
    //                     if($checkOrder->isNotEmpty())
    //                     {
    //                         echo "here";
    //                          return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_customer,"order_id"=> $getOrderId,"order_no"=>$getOrderNo]);
    //                     }
    //                     $insert_in = DB::table('driver')->insertGetId([
    //                         'customer_phone' => $no,
    //                         'order_id' => $getOrderId,
    //                         'order_no' => $getOrderNo,
    //                     ]);
    //                     $insert_in = DB::table('orders')->where('id',$getOrderId)->update([
    //                         'order_in_driver'=>"yes",
    //                     ]);
    //                 }
    //             }
    //           else {
    //             //   echo "here";
    //             return response()->json(['status' => 'failed', 'message' => 'No data found']);
    //         }
    //             }

    //             return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_customer,"order_id"=> $getOrderId,"order_no"=>$getOrderNo]);
    //         } else {
    //             // echo "here2";
    //             return response()->json(['status' => 'failed', 'message' => 'No data found']);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'Incomplete Param']);
    //     }
    // }
    //////////////////////////



    // old get order

    // public function GetOrder(Request $request)
    // {
    //     if (isset($request['customer_no']) && !empty($request['customer_no'])) {

    //         $get_customer = DB::table('users')->where('phone', $request['customer_no'])->first();
    //         $user_id = $get_customer->id;
    //         $user_name = $get_customer->first_name;
    //         if ($get_customer) {
    //             $get_order = DB::table('driver')
    //                 // ->join('order_details', 'driver.order_id', '=', 'order_details.order_id')
    //                 ->join('order_details', 'driver.add_to_cart_id', '=', 'order_details.add_to_cart_id')

    //                 // ->where('order_details.user_id', $user_id)
    //                 // ->where('orders.order_status', 'pending')
    //                 ->where('driver.delivery_status', 'pending')
    //                 ->select('*')
    //                 ->distinct('order_id')
    //                 ->get();
    //             $updated_orders = [];
    //             foreach ($get_order as $order) {
    //                 $order->user_name = $user_name;
    //                 $updated_orders[] = $order;
    //             }
    //             if ($get_order->isEmpty()) {
    //                 return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_customer, 'order_details' => $updated_orders]);
    //             }


    //             return response()->json(['status' => 'success', 'message' => 'data fetched successfully',  'data' => $get_customer, 'order_details' => $updated_orders]);
    //         } else {
    //             echo here2;
    //             return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_customer]);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'incomplete Param']);
    //     }
    // }


    public function GetOrder(Request $request)
    {
        if (isset($request['customer_no']) && !empty($request['customer_no'])) {

            $get_customer = DB::table('users')->where('phone', $request['customer_no'])->first();
            $user_id = $get_customer->id;
            $user_name = $get_customer->first_name;
            if ($get_customer) {

                $get_order = DB::table('driver')
                    ->join('order_details', 'driver.add_to_cart_id', '=', 'order_details.add_to_cart_id')
                    ->join('orders', 'order_details.order_id', '=', 'orders.id')
                    ->where('driver.delivery_status', 'pending')
                    ->where('orders.order_status', 'pending')
                    ->where('order_details.user_id', $user_id)
                    ->select('orders.*')
                    ->distinct('order_id')
                    ->get();
                // return $get_order;
                $updated_orders = [];
                foreach ($get_order as $order) {
                    $order->user_name = $user_name;
                    $updated_orders[] = $order;
                }
                if ($get_order->isEmpty()) {
                    return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_customer, 'order_details' => $updated_orders]);
                }


                return response()->json(['status' => 'success', 'message' => 'data fetched successfully',  'data' => $get_customer, 'order_details' => $updated_orders]);
            } else {
                echo here2;
                return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_customer]);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'incomplete Param']);
        }
    }
    ////////////////////////
    public function delivered_ok(Request $request)
    {
        if (isset($request['id']) && !empty($request['id'])) {
            $status_ok = DB::table('driver')->where('order_id', $request->id)->update([
                'Delivery_status' => 'ok'
            ]);
            $status_ok = DB::table('order_details')->where('order_id', $request->id)->update([
                'order_status' => 'delivery_ok'
            ]);
            if ($status_ok) {
                return response()->json(['status' => 'success', 'message' => 'Status Updated Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error Occured']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Incomplete Params']);
        }
    }
    public function Delivery_not_ok(Request $request)
    {
        if (
            isset($request['speak_manager']) && !empty($request['speak_manager']) and
            isset($request['Issue_Solved']) && !empty($request['Issue_Solved']) and
            isset($request['Customer_accept']) && !empty($request['Customer_accept']) and
            isset($request['id']) && !empty($request['id']) and isset($request['add_to_cart_id']) && !empty($request['add_to_cart_id'])
        ) {

            $add_to_cart_id = $request['add_to_cart_id'];


            $exp = explode(',', $add_to_cart_id);

            //  $exp =explode (',',$add_to_cart_id);
            $status_not_ok =   DB::table('driver')
                ->where('order_id', $request->id)
                ->whereIn('add_to_cart_id', $exp)
                ->update([
                    'Delivery_status' => 'not ok',
                    'Did_You_Speak_with_Manager' => $request['speak_manager'],
                    'Did_Issue_Solved' => $request['Issued_Solved'],
                    'Did_customer_accept' => $request['Customer_accept']
                ]);


            $status_not_ok =  DB::table('order_details')
                ->where('order_id', $request->id)
                ->whereIn('add_to_cart_id', $exp)
                ->update([
                    'order_status' => 'not ok',

                ]);

            $status_is_ok =   DB::table('driver')
                ->where('order_id', $request->id)
                ->whereNotIn('add_to_cart_id', $exp)
                ->update([
                    'Delivery_status' => "ok",
                ]);

            $status_is_ok =   DB::table('order_details')
                ->where('order_id', $request->id)
                ->whereNotIn('add_to_cart_id', $exp)
                ->update([
                    'order_status' => "ok",
                ]);


            if ($status_not_ok != 0) {
                return response()->json(['status' => 'success', 'message' => 'Status Updated Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error Occured']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Incomplete Param']);
        }
    }
    public function Item_not_Accepted(Request $request)
    {
        if (
            isset($request['item_not_accepted']) && !empty($request['item_not_accepted']) and
            isset($request['order_id']) && !empty($request['order_id'])
        ) {

            $item_not_accepted = $request['item_not_accepted'];
            $get_detail = DB::table('driver')->where('order_id', $request->order_id)->where('Delivery_status', "not ok")->first();
            $c_accept = $get_detail->Did_customer_accept;
            if ($c_accept == "no" || "yes") {

                $update_customer_order = DB::table('driver')->where('order_id', $request->order_id)->update(
                    [
                        'Item_not_Accepted' => $item_not_accepted
                    ]
                );

                return response()->json(['status' => 'success', 'message' => 'item Added successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not Any Order Customer Accepted']);
            }
        } else {

            return response()->json(['status' => 'failed', 'message' => 'Incomplete Param']);
        }
    }

    // get Order detail api
    public function getAllOrder(Request $request, $id)
    {

        $get_details_order = [];

        $get_order_detail = DB::table('driver')
            ->where('order_id', $id)->get();

        if (sizeof($get_order_detail) > 0) {

            $get_cart_id = DB::table('orders')->where('id', $id)->get('add_to_cart_id');

            // splitting the string

            $array = preg_split("/[:,]/", $get_cart_id);

            unset($array[0]);

            // function to remove doubles quotes

            $array = array_map(
                function ($value) {
                    return str_replace('"', '', $value);
                },
                $array
            );


            foreach ($array as $cart_id) {
                $get_cart_detail = DB::table('add_to_carts')->where('id', $cart_id)->get();

                foreach ($get_cart_detail as $cart_single) {

                    array_push($get_details_order, $cart_single);
                }
            }

            // checking if the data found

            if (sizeof($get_details_order) > 0) {

                return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Data Successfully Fetched', 'data' => $get_details_order]);
            } else {

                return response()->json(['code' => 200, 'status' => 'failed', 'message' => 'Not Found In Cart']);
            }
        } else {

            return response()->json(['code' => 401, 'status' => 'failed', 'message' => 'No data Found']);
        }
    }

    public function explainQuestion(Request $request)
    {
        if (isset($request['explain']) && !empty($request['explain'])) {
            $ansr_Q = DB::table('driver')->where('order_id', $request['id'])->update([
                'What_happened' => $request['explain']
            ]);
            if ($ansr_Q) {
                return response()->json(['status' => 'success', 'code' => 200, 'message' => 'Submitted Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'code' => 204, 'message' => 'Error Occured Try Again']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Incomplete Param']);
        }
    }

    // public function BuildYourOwnPizza(Request $request)
    // {
    //     $rules =
    //         [
    //             'cat_name' => "required",
    //             'name' => "required",
    //             'quantity' => "required",
    //             'cheese' => "required",
    //             'cheese_price' => "required",
    //             'sauce' => "required",
    //             'sauce_price' => "required",
    //             'topping' => "required",
    //             'topping_price' => "required",
    //             'cold_drink' => "required",
    //             'quantity' => "required",
    //             'product_id' => "required",
    //             'first_half' => "required",
    //             'second_half' => "required",
    //             'first_half_topping' => "required",
    //             'second_half_topping' => "required"

    //         ];
    //     if ($request->hasFile('image')) {
    //         $extension = $request['image']->extension();
    //         $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];
    //         $check = in_array($extension, $allowedfileExtension);

    //         if ($check) {
    //             $extension = "." . $request->image->getClientOriginalExtension();
    //             $name = basename($request->image->getClientOriginalName(), $extension) . time();
    //             $name1 = $name . $extension;
    //             $request->image->move('images/pizza-images/', $name1);
    //         } else {

    //             return response()->json(['status' => 'failed', 'message' => 'file should be image ']);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'image is required']);
    //     }
    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->passes()) {

    //         $add_s_pizza = DB::table('ownpizza')->insertGetId(
    //             [
    //                 'name' => $request->name,
    //                 'image' => '/pizza-images' . '/' . $name1,
    //                 'quntity' => $request->quantity,
    //                 'price1' => $request->price1,
    //                 'price2' => $request->price2,
    //                 'size1' => $request->size1,
    //                 'cheese' => $request->cheese,
    //                 'cheese_price' => $request->cheese_price,
    //                 'sauce' => $request->sauce,
    //                 'sauce_price' => $request->sauce_price,
    //                 'topping' => $request->topping,
    //                 'topping_price' => $request->topping_price,
    //                 'dough_price1' => $request->dough_price1,
    //                 'dough_price2' => $request->dough_price2,
    //                 'first_half' => $request->first_half,
    //                 'second_half' => $request->second_half,
    //                 'first_half_topping' => $request->first_half_topping,
    //                 'second_half_topping' => $request->second_half_topping,
    //                 'created_at' => Carbon::now()
    //             ]
    //         );

    //         if ($add_s_pizza) {
    //             $random_number = mt_rand(10000000, 99999999);

    //             $add_to_cart = DB::table('add_to_carts')->insert([
    //                 'build_pizza' => $add_s_pizza,
    //                 'order_no' => $random_number,
    //                 'drinks' => $request->cold_drink,
    //                 'quantity' => $request->quantity,
    //                 'user_id' => 3,
    //                 'product_id' => $request->product_id
    //             ]);

    //             if ($add_to_cart == "true") {

    //                 return response()->json(['status' => 'success', 'message' => 'inserted successfully']);
    //             } else {
    //                 return response()->json(['status' => 'success', 'message' => 'Error occured']);
    //             }
    //         } else {

    //             return response()->json(['status' => 'failed', 'message' => 'Not inserted try again']);
    //         }
    //     } else {

    //         $errors = $validator->errors();
    //         return response()->json(['status' => 'failed', 'error' => $errors]);
    //     }
    // }

    // // get your own pizza
    // public function get_own_pizza(Request $request)
    // {
    //     if (
    //         isset($request['id']) && !empty($request['id'])
    //     ) {
    //         $id = $request->id;
    //         $get_pizza_from_cart = DB::table('add_to_carts')->where('id', $id)->first();
    //         if ($get_pizza_from_cart) {
    //             $get_id = $get_pizza_from_cart->build_pizza;

    //             $get_drink = $get_pizza_from_cart->drinks;

    //             $get_order_no = $get_pizza_from_cart->order_no;

    //             $get_own_pizza = DB::table('ownpizza')->where('id', $get_id)->get();
    //             if ($get_own_pizza) {
    //                 return response()->json(['code' => 200, 'status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_own_pizza, 'drinks' => $get_drink, 'order_no' => $get_order_no]);
    //             } else {
    //                 return response()->json(['code' => 301, 'status' => 'failed', 'message' => 'No data found']);
    //             }
    //         }
    //     } else {
    //         return response()->json(['code' => 406, 'status' => 'failed', 'message' => 'id is required']);
    //     }
    // }
    // public function register(Request $request, User $user)
    // {
    //     //validate incoming request
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'username' => 'required|unique:users|max:20',
    //         'email' => 'required|email|unique:users|max:50',
    //         'password' => 'required|min:3', // ['required', 'min:3', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[-]).*$/',]
    //         'phone' => 'required|numeric|unique:users',
    //         'pin' => 'unique:users|max:4'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
    //     } else {
    //         try {
    //             $user->username = $request->input('username');
    //             $user->first_name = $request->input('first_name');
    //             $user->last_name = $request->input('last_name');
    //             $user->email = $request->input('email');
    //             $plainPassword = $request->input('password');
    //             $user->password = app('hash')->make($plainPassword);
    //             $user->phone = $request->input('phone');
    //             if (!empty($request->pin)) {
    //                 $user->role = $request->role;
    //                 $user->pin = $request->pin;
    //             }
    //             if ($user->save()) {
    //                 return $this->login($request);
    //             }
    //             return response()->json(['user' => $user, 'message' => 'User Created Succesfully', 'err' => $err], 201);
    //         } catch (\Exception $e) {
    //             return response()->json(['message' => 'User Registration Failed!'], 409);
    //         }
    //     }
    // }

    // // edit Your Own pizza
    // public function edit_your_own_pizza(Request $request)
    // {
    //     if (isset($request['id']) && !empty($request['id'])) {
    //         $find_id = DB::table('ownpizza')->where('id', $request->id)->get();
    //         if (sizeof($find_id) > 0) {
    //             $edit_own_pizza = DB::table('ownpizza')->where('id', $request->id)->update([
    //                 'first_half_topping' => $request->first_half_topping,
    //                 'second_half_topping' => $request->second_half_topping,
    //                 'cheese_price' => $request->cheese_price,
    //                 'cheese' => $request->cheese,
    //                 'sauce_price' => $request->sauce_price,
    //                 'sauce' => $request->sauce
    //             ]);
    //             if ($edit_own_pizza) {
    //                 return response()->json(['status' => 'success', 'message' => 'edited successfully']);
    //             } else {
    //                 return response()->json(['status' => 'failed', 'message' => 'not edited tru again']);
    //             }
    //         } else {
    //             return response()->json(['status' => 'failed', 'message' => 'no data found']);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'incomplete params']);
    //     }
    // }
}
