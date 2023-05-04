<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Sauce;
use App\Models\Api\Dipping;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class SauceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Sauce::orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $data]);
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
    public function store(Request $request, Sauce $sauce)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/sauce-images/', $name);
                }
                $sauce->create([
                    'name' => $request->name,
                    'image' => 'sauce-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Sauce Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Sauce"]);
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
            $data = Sauce::findOrFail($id);
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
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                $sauce = Sauce::find($id);
                if ($request->hasFile('image')) {
                    $filename = $sauce->image;
                    if (!$filename == null) {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        unlink($file_path);
                    }
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/sauce-images/', $name);
                }
                $sauce->update([
                    'name' => $request->name,
                    'image' => 'sauce-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Sauce updated Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error updated Sauce"]);
            }
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
        $sauce = Sauce::findOrFail($id);
        $filename = $sauce->image;
        if (!$filename == null) {
            $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
            unlink($file_path);
        }
        if ($sauce->delete()) {
            return response()->json(['status' => 'success', 'msg' => $sauce->name . " Sauce Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function addDipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dipping_name' => 'required',
            'dipping_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'dipping_quantity' => 'required',
            'dipping_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {

            $dipping = new Dipping();
            if ($request->hasFile('dipping_image')) {
                $extension = "." . $request->dipping_image->getClientOriginalExtension();
                $name = basename($request->dipping_image->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;
                $request->dipping_image->move('images/dipping-images/', $name);
            }
            $dipping->create([
                'dipping_name' => $request->dipping_name,
                'dipping_price' => $request->dipping_price,
                'dipping_quantity' => $request->dipping_quantity,
                'dipping_image' => 'dipping-images/' . $name,
                'free_dipping' => $request->free_dipping,
            ]);

            return response()->json(['status' => 'success', 'message' => "Dipping added successfully!!"]);
        }
    }

    public function getDipping()
    {
        $get = Dipping::get();

        return response()->json(['code' => 200, 'status' => "success", 'message' => "Dipping added successfully!", 'data' => $get]);
    }
}
