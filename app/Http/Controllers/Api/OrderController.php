<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\AddToCart;
use App\Models\Api\Order;
use App\Models\Api\Disc;
use App\Models\Api\OrderDetails;
use App\Models\Api\CompletedOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {

            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order, OrderDetails $orderDetails)
    {
        $validator = Validator::make($request->all(), [
            'cart_ids' => 'required',
            'order_no' => 'required|unique:orders',
            'total_price' => 'required',
            'customer_phone' => 'required',
            'shipping_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                $explode_id = explode(',', $request->cart_ids);
                $cartCount = AddToCart::whereIn('id', $explode_id)->where('add_cart_to_order_status', 0)->get();
                if (count($cartCount) > 0) {
                    $data =  $order->create([
                        'user_id' => auth()->user()->id,
                        'add_to_cart_id' => $request->cart_ids,
                        'order_no' => $request->order_no,
                        'tip' => $request->tip,
                        'discount' => $request->discount,
                        'delivery_fee' => $request->delivery_fee,
                        'total_price' => $request->total_price,
                        'shipping_address' => $request->shipping_address,
                        'transaction_no' => $request->transaction_no,
                        'customer_phone' => $request->customer_phone,
                        'table_no' => $request->table_no,
                    ]);

                    $order_id = $data->id;
                    // dd($order_id);

                    $explode_id = explode(',', $data->add_to_cart_id);
                    AddToCart::whereIn('id', $explode_id)->update([
                        'add_cart_to_order_status' => 1,
                        'order_no' => $request->order_no,
                        'order_id' => $order_id,
                    ]);

                    $data1 = [];
                    $explode_id = explode(',', $request->cart_ids);
                    foreach ($explode_id as $cart_id) {
                        $data1[] = $orderDetails->create([
                            'order_id' => $order_id,
                            'user_id' => auth()->user()->id,
                            'add_to_cart_id' => $cart_id,
                            'order_no' => $request->order_no,
                            'tip' => $request->tip,
                            'discount' => $request->discount,
                            'delivery_fee' => $request->delivery_fee,
                            'total_price' => $request->total_price,
                            'shipping_address' => $request->shipping_address,
                            'transaction_no' => $request->transaction_no,
                            'customer_phone' => $request->customer_phone,
                            'table_no' => $request->table_no,
                        ]);
                    }
                } else {
                    return response()->json(['status' => 'failed', 'msg' => "cart not available!! Please enter the correct available stock!!"]);
                }
                return response()->json(['status' => 'success', 'msg' => " Order Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Product"]);
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
            $data = Order::where('id', $id)->get();
            foreach ($data as  $key) {
                $explode_id = explode(',', $key->add_to_cart_id);
                $cart =  AddToCart::with('product')->whereIn('id', $explode_id)->get();
                $key->cart = $cart;
            }
            return response()->json(['status' => 'success', 'data' => $data[0]]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'msg' => "No data found!!"]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function SearchByOrderNumber(Request $request)
    {
        try {
            $order = Order::where('order_no', $request->query('order_no'))->get();
            if (count($order) != 0 && $order[0]->send_to_kitchen === 0) {
                foreach ($order as  $key) {
                    $explode_id = explode(',', $key->add_to_cart_id);
                    $cart =  AddToCart::with('product')->whereIn('id', $explode_id)->get();
                    $key->cart = $cart;
                }
                return response()->json(['status' => 'success', 'data' => $order[0]]);
            } else {
                return response()->json(['status' => 'failed', 'msg' => "No data found!!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'failed', 'msg' => "No data found!!"]);
        }
    }

    public function sendToKitchen(Request $request)
    {
        try {
            $order = Order::find($request->query('order_id'));
            $order->update([
                'send_to_kitchen' => 1
            ]);
            return response()->json(['status' => 'success', 'msg' => "order send to kitchen!!"]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'failed', 'msg' => "Error!!"]);
        }
    }



    // new pizz app api start here 2/23/2023

    public function getOrders(Request $request)
    {
        if (isset($request['user_id']) && !empty($request['user_id'])) {
            $atg = array();
            $user_id = $request['user_id'];
            $getMember = DB::table('orders')
                // ->distinct('club_id')

                ->join('users', 'users.id', '=', 'orders.user_id')
                ->where('user_id', $user_id)
                // ->where('club_room_schedules.privacy', $privacy)
                ->get(['orders.order_no', 'users.first_name', 'users.phone', 'orders.shipping_address']);

            // dd($getMember);

            if ($getMember) {
                foreach ($getMember as $data) {
                    $order = $data->order_no;


                    $users = DB::table('orders')
                        // ->distinct('room_id')
                        ->join('add_to_carts', 'orders.order_no', 'add_to_carts.order_no')
                        ->where('add_to_carts.order_no', $order)

                        ->get(['add_to_carts.*', 'orders.id as order_id', 'orders.shipping_address']);
                    // dd($users);

                    $orders2 = DB::table('orders')
                        ->join('discs', 'discs.order_no', '=', 'orders.order_no')
                        ->get(['orders.*']);
                    if ($users) {
                        foreach ($users as $or1234) {
                            //Do nothing
                            // array_push($atg, $or1234);
                        }

                        $data->order_details = $users;
                    } else {

                        return response()->json(['code' => 401, 'status' => "failed", 'message' => "No order exist!"]);
                    }
                    array_push($atg, $data);
                    //  $data->par_details = $atg;


                }
                return response()->json(['code' => 200, 'status' => "success", 'message' => "Order details fetched successfully!", 'data' => $atg]);
            }
        } else {
            $atg = array();

            $getMember = DB::table('orders')
                // ->distinct('club_id')

                // ->join('add_to_carts', 'add_to_carts.order_no', '=', 'orders.order_no')
                ->where('orders.deleted_at', NULL)
                // ->where('club_room_schedules.privacy', $privacy)
                ->get(['orders.order_no']);

            // dd($getMember);

            if ($getMember) {
                foreach ($getMember as $data) {
                    $order = $data->order_no;


                    $users = DB::table('orders')
                        // ->distinct('room_id')
                        ->join('add_to_carts', 'orders.order_no', 'add_to_carts.order_no')
                        ->where('add_to_carts.order_no', $order)

                        ->get(['add_to_carts.*', 'orders.id as order_id', 'orders.shipping_address']);
                    // dd($users);

                    $orders2 = DB::table('orders')
                        ->join('discs', 'discs.order_no', '=', 'orders.order_no')
                        ->get(['orders.*']);
                    if ($users) {
                        foreach ($users as $or1234) {
                            //Do nothing
                            // array_push($atg, $or1234);
                        }

                        $data->order_details = $users;
                    } else {

                        return response()->json(['code' => 401, 'status' => "failed", 'message' => "No order exist!"]);
                    }
                    array_push($atg, $data);
                    //  $data->par_details = $atg;


                }
                return response()->json(['code' => 200, 'status' => "success", 'message' => "Order details fetched successfully!", 'data' => $atg]);
            }
        }
    }


    //     public function getOrders(Request $request)
    // {
    //     $atg = array();

    //         $getMember = DB::table('orders')
    //             // ->distinct('club_id')

    //             // ->join('add_to_carts', 'add_to_carts.order_no', '=', 'orders.order_no')
    //             ->where('orders.deleted_at',NULL)
    //             // ->where('club_room_schedules.privacy', $privacy)
    //             ->get(['orders.order_no']);

    //             // dd($getMember);

    //         if ($getMember)
    //         {
    //             foreach ($getMember as $data)
    //             {
    //                 $order =$data->order_no;


    //                     $users = DB::table('orders')
    //                     // ->distinct('room_id')
    //                     ->join('add_to_carts','orders.order_no','add_to_carts.order_no')
    //                     ->where('add_to_carts.order_no',$order)

    //                     ->get(['add_to_carts.*']);
    //                     // dd($users);

    //                     $orders2 = DB::table('orders')
    //                             ->join('discs','discs.order_no','=','orders.order_no')
    //                             ->get(['orders.*']);
    //                     if ($users)
    //                     {
    //                         foreach ($users as $or1234)
    //                         {
    //                             //Do nothing
    //                             // array_push($atg, $or1234);
    //                         }

    //                         $data->order_details = $users;

    //                     }
    //                     else
    //                     {

    //                         return response()->json(['code' => 401, 'status' => "failed", 'message' => "No order exist!"]);
    //                     }
    //                     array_push($atg, $data);
    //                     //  $data->par_details = $atg;


    //             }
    //             return response()->json(['code' => 200, 'status' => "success", 'message' => "Order details fetched successfully!", 'data' => $atg]);
    //         }
    //     }



    public function addDisc(Request $request)
    {
        if (isset($request['disc_no']) && !empty($request['disc_no'])) {

            $emp_id = $request['emp_id'];
            $disc_no = $request['disc_no'];
            $status = $request['emp_id'];
            $add_to_cart_id = $request['add_to_cart_id'];

            $getEmpDisc = DB::table('discs')
                // ->where('emp_id',$emp_id)
                ->where('disc_no', $disc_no)
                ->get();
            if ($getEmpDisc->isNotEmpty()) {
                return response()->json(['code' => 401, 'status' => "failed", 'message' => "Disc already assigned a order!"]);
            }
            // $getEmp = DB::table('discs')
            //             ->where('emp_id',$emp_id)
            //             ->get();

            // if($getEmp->isNotEmpty())
            // {
            //     return response()->json(['code'=>401,'status'=>"failed",'message'=>"Employee already assigned a order!"]);
            // }
            $getDisc = DB::table('discs')
                ->where('disc_no', $disc_no)
                ->get();
            if ($getDisc->isNotEmpty()) {
                return response()->json(['code' => 401, 'status' => "failed", 'message' => "Disc already fill!"]);
            }
            $add_disc = new Disc();

            $add_disc->disc_no = $request->disc_no;
            $add_disc->emp_id = $request->emp_id;
            $add_disc->order_no = $request->order_no;
            $add_disc->product_details_id = $request->product_details_id;
            $add_disc->add_to_cart_id = $request->add_to_cart_id;
            $add_disc->status = "in_oven";

            $add_disc->save();

            if ($add_disc) {
                $updateDisc = DB::table('add_to_carts')
                    ->where('order_no', $request->order_no)
                    ->where('id', $request->add_to_cart_id)
                    ->where('product_id', $request->product_details_id)
                    ->update([
                        'emp_id' => $request->emp_id,
                        'disc_no' => $request->disc_no,
                        'disc_status' => "in_oven",

                    ]);

                return response()->json(['status' => 201, 'message' => 'Disc added successfully', 'data' => $add_disc]);
            }
        } else {
            return response()->json(['status' => 204, 'message' => 'not added to kitchen']);
        }
    }

    public function viewDisc(Request $request)
    {
        if (isset($request['disc_no']) && !empty($request['disc_no'])) {
            $disc_no = $request['disc_no'];
            $getMember = DB::table('add_to_carts')
                ->where('disc_no', $disc_no)
                ->where('waiting_for_driver', 'no')
                ->get();
            if ($getMember->isNotEmpty()) {
                return response()->json(['code' => 200, 'status' => "success", 'message' => "Discs details fetched successfully!", 'data' => $getMember]);
            } else {
                return response()->json(['code' => 401, 'status' => "failed", 'message' => "No disc assign"]);
            }
        } else {
            $atg = array();

            $getMember = DB::table('add_to_carts')
                ->where('waiting_for_driver', 'no')
                // ->distinct('club_id')

                // ->join('discs', 'add_to_carts.order_no', '=', 'discs.order_no')

                // ->where('club_room_schedules.privacy', $privacy)
                ->get(['add_to_carts.*']);

            // dd($getMember);

            if ($getMember) {
                // foreach ($getMember as $data)
                // {
                //     $order =$data->order_no;

                //         echo $order . " ";

                //         $users = DB::table('add_to_carts')
                //         // ->join('discs', 'add_to_carts.order_no', '=', 'discs.order_no')
                //         // ->distinct('room_id')

                //         // ->where('add_to_carts.order_no',$order)

                //         ->get(['add_to_carts.*']);
                //         // dd($users);
                //         if ($users)
                //         {
                //             // foreach ($users as $or1234)
                //             // {
                //             //     //Do nothing
                //             //     // array_push($atg, $or1234);
                //             // }
                //             $data->order_details = $users;
                //         }
                //         else
                //         {

                //             return response()->json(['code' => 401, 'status' => "failed", 'message' => "No disc found exist!"]);
                //         }
                //         array_push($atg, $data);
                //         //  $data->par_details = $atg;


                // }
                return response()->json(['code' => 200, 'status' => "success", 'message' => "Discs details fetched successfully!", 'data' => $getMember]);
            }
        }
    }


    public function addOven(Request $request)
    {
        if (isset($request['disc_no']) && !empty($request['disc_no'])) {

            $disc_no = $request['disc_no'];


            $getEmpDisc = DB::table('discs')

                ->where('disc_no', $disc_no)
                ->where('status', 'in_oven')
                ->get();

            if ($getEmpDisc->isNotEmpty()) {
                return response()->json(['code' => 401, 'status' => "failed", 'message' => "Pizza already in oven!"]);
            }

            $updateStatus = DB::table('discs')
                ->where('disc_no', $disc_no)
                ->update([
                    'status' => "in_oven",
                ]);
            if ($updateStatus) {
                DB::table('add_to_carts')
                    ->where('disc_no', $disc_no)
                    ->update([
                        'disc_status' => "in_oven",
                    ]);
            }

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Pizza add to oven successfully!']);
        } else {
            return response()->json(['status' => 204, 'message' => 'incopmlete parameters!']);
        }
    }

    public function removeFromDisk(Request $request)
    {
        if (isset($request['disc_no']) && !empty($request['disc_no'])) {
            $disc_no = $request['disc_no'];
            $getDisc = DB::table('discs')
                ->where('disc_no', $disc_no)
                ->first();


            $getCart = DB::table('add_to_carts')
                ->where('disc_no', $disc_no)
                ->first();
            // dd($getCart);
            $user_id = $getCart->user_id;
            // dd($user_id);
            $getPhone = DB::table('orders')
                ->where('user_id', $user_id)
                ->first();
            // dd($getPhone);

            if ($getDisc == !null) {
                $emp_id = $getDisc->emp_id;

                $completedOrders = new CompletedOrders();
                $completedOrders->user_id = $getCart->user_id;
                $completedOrders->customer_phone = $getPhone->customer_phone;
                $completedOrders->product_id = $getCart->product_id;
                $completedOrders->pizza_name = $getCart->pizza_name;
                $completedOrders->pizza_image = $getCart->pizza_image;
                $completedOrders->pizza_image = $getCart->pizza_image;
                $completedOrders->quantity = $getCart->quantity;
                $completedOrders->size = $getCart->size;
                $completedOrders->price = $getCart->price;
                $completedOrders->drinks = $getCart->drinks;
                $completedOrders->drink_quantity = $getCart->drink_quantity;
                $completedOrders->drink_size = $getCart->drink_size;
                $completedOrders->drink_price = $getCart->drink_price;
                $completedOrders->cheese = $getCart->cheese;
                $completedOrders->cheese_pizza_side = $getCart->cheese_pizza_side;
                $completedOrders->cheese_price = $getCart->cheese_price;
                $completedOrders->sauce = $getCart->sauce;
                $completedOrders->sauce_price = $getCart->sauce_price;
                $completedOrders->topping_pizza_side = $getCart->topping_pizza_side;
                $completedOrders->topping_type = $getCart->topping_type;
                $completedOrders->regular_toppings = $getCart->regular_toppings;
                $completedOrders->regular_topping_price = $getCart->regular_topping_price;
                $completedOrders->extra_dressing = $getCart->extra_dressing;
                $completedOrders->ex_dressing_price = $getCart->ex_dressing_price;

                $completedOrders->appitizer = $getCart->appitizer;
                $completedOrders->appitizer_price = $getCart->appitizer_price;
                $completedOrders->dipping_name = $getCart->dipping_name;
                $completedOrders->dipping_price = $getCart->dipping_price;
                $completedOrders->dipping_quantity = $getCart->dipping_quantity;
                $completedOrders->order_no = $getCart->order_no;
                $completedOrders->add_to_cart_id = $getCart->id;
                $completedOrders->order_status = "Completed";
                $completedOrders->save();

                $disc_no = $request['disc_no'];
                $getDiscNo = DB::table('add_to_carts')
                    ->where('disc_no', $disc_no)
                    ->where('emp_id', $emp_id)
                    ->first();
                $order_id = $getDiscNo->order_id;

                $getAllOrderId = DB::table('add_to_carts')
                    ->where('order_id', $order_id)
                    ->get(['id', 'order_id', 'order_no']);

                $orderIds = [];

                foreach ($getAllOrderId as $item) {
                    $orderIds[] = [
                        'order_id' => $item->order_id,
                        'order_no' => $item->order_no,
                        'add_to_cart_id' => $item->id,
                    ];
                }
                // print_r ($orderIds);

                $checkOrder = DB::table('add_to_carts')
                    ->where('order_id', $item->order_id)
                    ->where('waiting_for_driver', 'no')
                    ->count();

                if ($checkOrder == "1") {
                    // echo "here";
                    $update = DB::table('add_to_carts')
                        ->where('disc_no', $disc_no)
                        ->where('emp_id', $emp_id)
                        ->update([
                            'waiting_for_driver' => "Yes",
                        ]);

                    DB::table('driver')->insert($orderIds);

                    $inserted = DB::table('driver')->where('order_id', $item->order_id)->update([
                        "customer_phone" => $getPhone->customer_phone,
                        // 'order_id' => $orderIds,
                        // 'order_no' => $getDiscNo->order_no,

                        // Add additional columns and their corresponding data as necessary
                    ]);


                    $disc_no = $request['disc_no'];
                    $getDisc = DB::table('discs')
                        ->where('disc_no', $disc_no)
                        ->where('emp_id', $emp_id)
                        ->delete();


                    $update = DB::table('add_to_carts')
                        // ->where('disc_no',$disc_no)
                        ->where('waiting_for_driver', "Yes")
                        ->where('order_id', $order_id)
                        ->delete();
                }
                $disc_no = $request['disc_no'];
                $getDisc = DB::table('discs')
                    ->where('disc_no', $disc_no)
                    ->where('emp_id', $emp_id)
                    ->delete();


                // $disc_no = $request['disc_no'];
                // $getDisc = DB::table('discs')
                // ->where('disc_no',$disc_no)
                // ->where('emp_id',$emp_id)
                // ->delete();

                // $update = DB::table('add_to_carts')
                // ->where('disc_no',$disc_no)
                // ->where('emp_id',$emp_id)
                // ->delete();

                $update = DB::table('add_to_carts')
                    ->where('disc_no', $disc_no)
                    ->where('emp_id', $emp_id)
                    ->update([
                        'waiting_for_driver' => "Yes",
                    ]);

                return response()->json(['code' => 200, 'status' => "success", 'message' => "Disk removed successfully!"]);
            } else {
                return response()->json(['code' => 401, 'status' => 'failed', 'message' => 'Disc no not available!']);
            }
        } else {
            return response()->json(['status' => 401, 'message' => 'Incomplete parameters!']);
        }
    }

    public function completedOrders(Request $request)
    {

        $getOrders = DB::table('completed_orders')

            ->get();
        if ($getOrders->isNotEmpty()) {
            return response()->json(['code' => 200, 'status' => "success", 'message' => "Completed orders fetched successfully!", 'data' => $getOrders]);
        } else {
            return response()->json(['code' => 401, 'status' => 'failed', 'message' => 'Completed order is empty!']);
        }
    }

    public function getAllOrders(Request $request)
    {
        if (isset($request['user_id']) && !empty($request['user_id'])) {
            $user_id = $request['user_id'];

            $getPendingOrder = DB::table('add_to_carts')->selectRaw('add_to_carts.*, users.phone as customer_phone')
                ->join('users', 'users.id', '=', 'add_to_carts.user_id')
                ->where('add_to_carts.user_id', $user_id)
                ->get();

            $getCompletedOrder = DB::table('completed_orders')
                ->where('user_id', $user_id)
                ->get();
            $response = [];

            $response = array([
                'pending_orders' => $getPendingOrder->toArray(),
                'completed_orders' => $getCompletedOrder->toArray(),
            ]);

            if ($response) {
                return response()->json(['code' => 200, 'status' => "success", 'message' => "All orders fetched successfully!", 'data' => $response]);
            } else {
                return response()->json(['code' => 401, 'status' => 'failed', 'message' => 'No order exist!']);
            }
        } else {
            return response()->json(['code' => 401, 'status' => 'failed', 'message' => 'Incomplete Parameter!']);
        }
    }
}
