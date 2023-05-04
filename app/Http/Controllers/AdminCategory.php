<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\File;
use PDO;
use Validator;


class AdminCategory extends Controller
{
    public function Addcoupon(Request $request)
    {
        $rules =
            [
                'coupon_number' => "required",
                'type' => "required",
                'discount' => "required",
                'expiry_date' => "required"
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $add_coupon = DB::table('coupons')->insert([
                'coupon_number' => $request->coupon_number,
                'type' => $request->type,
                'discount' => $request->discount,
                'status' => 0,
                'expiry_date' => $request->expiry_date,
                'created_at' => Carbon::now()
            ]);
            if ($add_coupon == "true") {
                return response()->json(['status' => 'success', 'message' => 'Coupon Successfully Added']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error Adding coupon']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }
    public function DeleteCoupon($id)
    {
        $find_id = DB::table('coupons')->where('id', $id)->exists();
        if ($find_id == "true") {
            $delete_coupons = DB::table('coupons')->where('id', $id)->delete();
            if ($delete_coupons == "1") {
                return response()->json(['status' => 'success', 'message' => 'coupons deleted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not Deleted Try Again']);
            }
        } else {
            return response()->json(['status' => 'success', 'message' => 'No Data Found']);
        }
    }
    public function getCoupons()
    {
        $get_coupons = DB::table('coupons')->get();
        if (sizeof($get_coupons) > 0) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_coupons]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }
    public function GetEditCoupons(Request $request, $id)
    {
        $find_id = DB::table('coupons')->where('id', $id)->exists();
        // dd($find_id);
        if ($find_id == "true") {
            $get_coupons = DB::table('coupons')->where('id', $id)->get();
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_coupons]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }
    public function EditCoupon(Request $request, $id)
    {
        $find_id = DB::table('coupons')->where('id', $id)->exists();
        if ($find_id == "true") {
            $update_coupon = DB::table('coupons')->where('id', $id)->update([
                'coupon_number' => $request->coupon_number,
                'type' => $request->type,
                'discount' => $request->discount,
                'expiry_date' => $request->expiry_date,
                'updated_at' => Carbon::now()
            ]);
            if ($update_coupon == "1") {
                return response()->json(['status' => 'success', 'message' => 'data fetched successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error updating coupon']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }


    public function addCategory(Request $request)
    {
        $rules =
            [
                'desc' => "required",
                'name' => "required",
                'image' => "required"

            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

            $imageupload = $request->file('image');
            $extension = $imageupload->extension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $uploadfile = 'category-images' . time() . '.' . $imageupload->extension();
                $path = public_path('images');
                $file = $imageupload->move($path, $uploadfile);
            } else {
                return response()->json(['message' => 'file should be image']);
            }
            try {
                
                $cat = DB::table('categories')->insert([
                    'parent_id' => $request['parent_id'] ?? 0, 
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => $uploadfile
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Category Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Category"]);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }
    public function ViewCategory(Request $req)
    {
        $all_category = DB::table('categories')->orderBy("id", "DESC")->get();
        if ($all_category) {
            return response()->json(['status' => 'success', 'data' => $all_category]);
        } else {
            return response()->json(['status' => 'failed', 'error' => 'No data found']);
        }
    }
    public function getArray(Request $req)
    {
        $all_category = DB::table('products')->get('array');
        return response()->json(['data' => $all_category]);
    }

    public function Edit_Category(Request $request, $id)
    {
        $find_id = DB::table('categories')->where('id', $id)->first();
        if ($find_id) {
            if ($request->hasFile('image')) {
                $filename = $find_id->image;
                if (!$filename == null) {
                    // unlink(storage_path('app/public/' . $filename));

                    $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                    $imageupload = $request->file('image');
                    $extension = $imageupload->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $uploadfile = 'category-images' . time() . '.' . $imageupload->getClientOriginalExtension();
                        $path = public_path('images');
                        $file = $imageupload->move($path, $uploadfile);
                    } else {
                        return response()->json('message', 'file should be image');
                    }
                } else {
                    $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                    $imageupload = $request->file('image');
                    $extension = $imageupload->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $uploadfile = 'category-images' . time() . '.' . $imageupload->getClientOriginalExtension();
                        $path = public_path('images');
                        $file = $imageupload->move($path, $uploadfile);
                    } else {
                        return response()->json('message', 'file should be image');
                    }
                }
                $update_sauce = DB::table('categories')->where('id', $id)->update([
                    'name' => $request->name,
                    'image' =>  $uploadfile,
                    'desc' => $request->description
                ]);
                if ($update_sauce) {
                    return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'Not updated try again']);
                }
            } else {
                $update_sauce = DB::table('categories')->where('id', $id)->update([
                    'name' => $request->name,
                    'desc' => $request->description
                ]);
                if ($update_sauce) {
                    return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'Not updated try again']);
                }
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Not data found']);
        }
    }
    // public function getDessert()
    // {
    //     $find_data = DB::table('products')->where('cat_name', 'Dessert')->get();
    //     if (sizeof($find_data) > 0) {
    //         return response()->json(['status' => 'success', 'message' => 'data feteched successfully', 'data' => $find_data]);
    //     } else {
    //         return response()->json(['status' => 'success', 'message' => 'no data found']);
    //     }
    // }
    // public function getDrinks()
    // {
    //     $find_data = DB::table('products')->where('cat_name', 'Drinks')->get();
    //     if (sizeof($find_data) > 0) {
    //         return response()->json(['status' => 'success', 'message' => 'data feteched successfully', 'data' => $find_data]);
    //     } else {
    //         return response()->json(['status' => 'success', 'message' => 'no data found']);
    //     }
    // }
    public function AddDisc(Request $request)
    {
        $rules =
            [
                'disc_no' => "required"
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $insert_disc = DB::table('discs')->insert([
                "disc_no" => $request->disc_no
            ]);
            if ($insert_disc == "true") {
                return response()->json(['status' => 'success', 'message' => 'Disc Added Succssfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in Adding disc']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }
    public function getDisc()
    {
        $find_data = DB::table('discs')->get();
        if (sizeof($find_data) > 0) {
            return response()->json(['status' => 'success', 'message' => 'data feteched successfully', 'data' => $find_data]);
        } else {
            return response()->json(['status' => 'success', 'message' => 'no data found']);
        }
    }
    public function RemoveDisc($id)
    {
        $find_data = DB::table('discs')->where('id', $id)->get();
        if (sizeof($find_data) > 0) {
            $remove_disc = DB::table('discs')->where('id', $id)->delete();
            if ($remove_disc == "1") {

                return response()->json(['status' => 'success', 'message' => 'Disc Removed Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error Disc Not Removed ']);
            }
        } else {
            return response()->json(['status' => 'success', 'message' => 'no data found']);
        }
    }
    public function Addsubcategory(Request $request)
    {
        $rules =
            [
                'category_id' => "required",
                'sub_cat_name' => "required"
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            try {
                $cat = DB::table('sub_categories')->insert([
                    'category_id' => $request->category_id,
                    'sub_cat_name' => $request->sub_cat_name,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Category Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Category"]);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }
    public function getsubCategory()
    {
        $get_subCategory = DB::table('sub_categories')->get();
        if (sizeof($get_subCategory) > 0) {
            return response()->json(['status' => 'Success', 'message' => 'data fetched successfully', 'data' => $get_subCategory]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }
    public function deletesubCategory($id)
    {
        $find_id = DB::table('sub_categories')->where('id', $id)->exists();
        if ($find_id == "true") {
            $delete_data = DB::table('sub_categories')->where('id', $id)->delete();
            if ($delete_data) {
                return response()->json(['status' => 'success', 'message' => 'data deleted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not Deleted']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }
    public function GeteditsubCategory($id)
    {
        $find_id = DB::table('sub_categories')->where('id', $id)->exists();
        if ($find_id == "true") {
            $get_category = DB::table('sub_categories')->where('id', $id)->get();

            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_category]);
        } else {
            return response()->json(['status' => 'success', 'message' => 'No data found']);
        }
    }
    public function editsubCategory(Request $request, $id)
    {
        $find_id = DB::table('sub_categories')->where('id', $id)->exists();
        if ($find_id == "true") {
            $get_category = DB::table('sub_categories')->where('id', $id)->update([
                'sub_cat_name' => $request->sub_cat_name,
                'category_id' => $request->category_id
            ]);
            // dd($get_category);
            if ($get_category) {
                return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not updated Try again']);
            }
        } else {
            return response()->json(['status' => 'success', 'message' => 'No data found']);
        }
    }
}
