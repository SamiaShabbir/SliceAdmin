<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\paymentDetail;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentDetailsController extends Controller
{
    public function addPaymentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'unique:payment_details|required',
            'first_name' => "required",
            'last_name' => "required",
            'street_address' => "required",
            'city' => "required",
            'state' => "required",
            'payment_type' => "required",
            'card_name' => "required",
            'card_no' => "required",
            'exp_month' => "required",
            'exp_year' => "required",
            'cvv' => "required",
            'order_status' => "required",

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            $addDetails = new paymentDetail();

            $addDetails->user_id = $request->user_id;
            $addDetails->first_name = $request->first_name;
            $addDetails->last_name = $request->last_name;
            $addDetails->street_address = $request->street_address;
            $addDetails->city = $request->city;
            $addDetails->state = $request->state;
            $addDetails->zip = $request->zip;
            $addDetails->additional_instruction = $request->additional_instruction;
            $addDetails->order_status = $request->order_status;
            $addDetails->delivery_scheduling = $request->delivery_scheduling;
            $addDetails->future_dev_time = $request->future_dev_time;

            $addDetails->payment_type = $request->payment_type;
            $addDetails->card_name = $request->card_name;
            $addDetails->card_no = $request->card_no;
            $addDetails->exp_month = $request->exp_month;
            $addDetails->exp_year = $request->exp_year;
            $addDetails->cvv = $request->cvv;

            $addDetails->save();

            return response()->json(['code' => 200, 'status' => "success", 'message' => "Payment details add successfully!", 'data' => $addDetails]);
        }
    }

    public function applyCoupon(Request $request)
    {

        if (isset($request['coupon_number']) && !empty($request['coupon_number'])) {

            $coupon_number = $request['coupon_number'];

            $users_p = DB::select('select * from coupons where coupon_number= ?', [$coupon_number]);
            if ($users_p) {
                return response()->json(['status' => 'success', 'data' => $users_p]);
            } else {
                return response()->json(['status' => 'failed', 'error' => 'Coupon number not valid or expire coupon!']);
            }
        } else {
            return response()->json(['status' => 'failed', 'error' => 'Incomplete Parameters']);
        }
    }
}
