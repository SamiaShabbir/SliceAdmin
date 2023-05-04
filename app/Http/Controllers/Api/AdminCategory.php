<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;
use Validator;
use App\Http\Controllers\Controller;

class AdminCategory extends Controller
{
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
                $image = $request->image;

                $imageName = time() . '.' . $image->Extension();
                $request->image->move(public_path('portfolio'), $imageName);
                $data->image = $imageName;
            } else {
                return response()->json(['message' => 'file should be image']);
            }
            try {
                $cat = DB::table('categories')->insert([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => $imageName
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
        $all_category = DB::table('categories')->get();
        if ($all_category) {
            return response()->json(['status' => 'success', 'data' => $all_category]);
        } else {
            return response()->json(['status' => 'failed', 'error' => 'No data found']);
        }
    }


    public function Edit_Category(Request $request, $id)
    {
        $find_id = DB::table('categories')->where('id', $id)->first();
        if ($find_id) {
            $filename = $find_id->image;
            if (!$filename == null) {
                // unlink(storage_path('app/public/' . $filename));

                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $uploadfile = '/' . time() . '.' . $imageupload->extension();
                    $request->image->move('public/category-images' . $uploadfile);
                } else {
                    return response()->json('message', 'file should be image');
                }
            } else {
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $uploadfile = '/' . time() . '.' . $imageupload->extension();
                    $request->image->move('public/category-images' . $uploadfile);
                } else {
                    return response()->json('message', 'file should be image');
                }
            }

            $update_sauce = DB::table('categories')->where('id', $id)->update([
                'name' => $request->name,
                'image' => 'category-images' . $uploadfile,
                'desc' => $request->description
            ]);
            if ($update_sauce) {
                return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not updated try again']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Not data found']);
        }
    }
}
