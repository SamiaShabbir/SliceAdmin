<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Topping;
use App\Models\Api\Dipping;
use App\Models\Api\ColdDrink;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = [];
            $cheese = Topping::whereNotNull('cheese')->get(['id', 'cheese', 'cheese_price', 'cheese_price_18', 'created_at', 'updated_at']);
            $sauce = Topping::whereNotNull('sauce')->get(['id', 'sauce', 'sauce_price', 'sauce_price_18', 'created_at', 'updated_at']);
            $regular_toppings_new = Topping::selectRaw('id,regular_toppings,regular_topping_price,regular_topping_price_18,less_price, less_price_18, normal_price,normal_price_18,extra_price,extra_price_18,created_at,updated_at')->orderBy("normal_price", "ASC")->get();
            //$regular_toppings = Topping::select('id','regular_toppings','regular_topping_price','less_price','normal_price','extra_price','created_at','updated_at')->get();
            $coldDrink = ColdDrink::get(['id', 'name', 'drink_price', 'image', 'drink_quantity', 'drink_size', 'created_at', 'updated_at']);
            $dipping = Dipping::get();

            $response = array([
                'cold_drink' => $coldDrink->toArray(),
                'cheese' => $cheese->toArray(),
                'sauce' => $sauce->toArray(),
                //'regular_toppings' =>$regular_toppings->toArray(),
                'dipping' => $dipping->toArray(),
                'regular_toppings' => $regular_toppings_new->toArray()
            ]);

            return response()->json(['status' => 'success', 'data' => $response]);
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
    public function store(Request $request, Topping $topping)
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
                    $request->image->move('images/topping-images/', $name);
                }
                $topping->create([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => 'topping-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Topping Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Topping"]);
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
            $data = Topping::findOrFail($id);
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
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                $topping = Topping::find($id);
                if ($request->hasFile('image')) {
                    $filename = $topping->image;
                    if (!$filename == null) {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        unlink($file_path);
                    }
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/topping-images/', $name);
                }
                $topping->update([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => 'topping-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Topping updated Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error updated Topping"]);
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
        $topping = Topping::findOrFail($id);
        $filename = $topping->image;
        if (!$filename == null) {
            $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
            unlink($file_path);
        }
        if ($topping->delete()) {
            return response()->json(['status' => 'success', 'msg' => $topping->name . " Topping Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }
}
