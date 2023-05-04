<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $data = User::findOrFail(auth()->user()->id);
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->hasFile('image')) {
            $filename = $data->image;
            if (!$filename == null) {
                $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                unlink($file_path);
            }
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;
            $request->image->move('images/profile-images/', $name);
            $data->image = 'profile-images/' . $name;
        }
        if ($data->update()) {
            return response()->json(['status' => 'success', 'message' => 'Profile updated Successfully!!']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Error Occured updated profile!!']);
        }
    }
}
