<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\ColdDrink;
use App\Models\Api\Desert;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class ColdDrinksController extends Controller
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
            $coldDrink = ColdDrink::get(['id', 'name', 'drink_price', 'image', 'drink_quantity', 'drink_size', 'created_at', 'updated_at']);
            //   $extra_topping=ColdDrink::get(['id','extra_dressing','ex_dressing_price','ex_dressing_image','created_at','updated_at']);
            // $appitizer = ColdDrink::get(['id','appitizer','appitizer_price','appitizer_image','created_at','updated_at']);
            $desert = Desert::get();

            $response = array([
                'cold_drink' => $coldDrink->toArray(),
                'desert' => $desert->toArray(),


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
    public function store(Request $request, ColdDrink $coldDrink)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:25',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'drink_price' => 'required',
            'drink_price' => 'required',
            'drink_quantity' => "required",
            'extra_dressing' => 'required',
            'ex_dressing_price' => 'required',
            'ex_dressing_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'appitizer' => 'required',
            'appitizer_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'appitizer_price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/coldDrinks-images/', $name);
                }

                if ($request->hasFile('ex_dressing_image')) {
                    $extension = "." . $request->ex_dressing_image->getClientOriginalExtension();
                    $name = basename($request->ex_dressing_image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->ex_dressing_image->move('images/ex-dressing-images/', $name);
                }



                if ($request->hasFile('appitizer_image')) {
                    $extension = "." . $request->appitizer_image->getClientOriginalExtension();
                    $name = basename($request->appitizer_image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->appitizer_image->move('images/appitizer-images/', $name);
                }

                $coldDrink->create([
                    'name' => $request->name,
                    'drink_price' => $request->drink_price,
                    'image' => 'coldDrinks-images/' . $name,
                    'drink_quantity' => $request->drink_quantity,
                    'drink_size' => $request->drink_size,
                    'extra_dressing' => $request->extra_dressing,
                    'ex_dressing_price' => $request->ex_dressing_price,
                    'ex_dressing_image' => 'ex-dressing-images/' . $name,
                    'appitizer' => $request->appitizer,
                    'appitizer_price' => $request->appitizer_price,
                    'appitizer_image' => 'appitizer-images/' . $name,

                ]);
                return response()->json(['status' => 'success', 'message' => " Cold Drink Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Cold Drink"]);
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
            $data = ColdDrink::findOrFail($id);
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
        $coldDrink = ColdDrink::findOrFail($id);
        if ($request->name) {
            $coldDrink->name = 'null';
            $coldDrink->save();
        }
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:25',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $filename = $coldDrink->image;
                    if (!$filename == null) {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        unlink($file_path);
                    }
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/coldDrinks-images/', $name);
                }
                $coldDrink->update([
                    'name' => $request->name,
                    'image' => 'coldDrinks-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " cold Drinks updated Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error updated cold Drinks"]);
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
        $coldDrink = ColdDrink::findOrFail($id);
        $filename = $coldDrink->image;
        if (!$filename == null) {
            $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
            unlink($file_path);
        }
        if ($coldDrink->delete()) {
            return response()->json(['status' => 'success', 'msg' => $coldDrink->name . " Product Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function addDesert(Request $request, Desert $desert)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:25',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'desert_price' => 'required',
            'desert_quantity' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/desert-images/', $name);
                }

                $desert->create([
                    'name' => $request->name,
                    'desert_price' => $request->desert_price,
                    'image' => 'desert-images/' . $name,
                    'desert_quantity' => $request->desert_quantity,


                ]);
                return response()->json(['status' => 'success', 'message' => " Desert added Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "Error desert not added"]);
            }
        }
    }
}
