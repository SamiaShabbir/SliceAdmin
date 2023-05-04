<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function addBanner(Request $request)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'banner_image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {

            if ($request->hasFile('banner_image')) {
                $extension = "." . $request->banner_image->Extension();
                $name = basename($request->banner_image->getClientOriginalName(), $extension) . time();
                $name = time() . $extension;
                $request->banner_image->move('images/banner-images/', $name);
            }

            $addBanner = new Banner();

            $addBanner->banner_image = 'banner-images/' . $name;

            $addBanner->save();

            return response()->json(['code' => 200, 'status' => 'success', 'msg' => $request->name . " Banner added successfully!!"]);
        }
    }

    public function viewBanner()
    {
        $getBanner = Banner::get();

        if ($getBanner != null) {
            return response()->json(['code' => 200, 'status' => "success", 'message' => 'Banner get successfully!', 'data' => $getBanner]);
        } else {
            return response()->json(['code' => 200, 'status' => "success", 'message', 'No Banner found!']);
        }
    }
}
