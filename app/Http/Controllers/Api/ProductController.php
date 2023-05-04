<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon;
use DB;
use App\Models\Api\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Product::orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {

            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function clearCache()
    {
        echo shell_exec("php artisan");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|unique:products|max:25',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'price' => 'required|max:11',
            'product_code' => 'required|max:11',
            'size1' => 'required|max:25',
            'size2' => 'required|max:25',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            // try {
            if ($request->hasFile('image')) {
                $extension = "." . $request->image->getClientOriginalExtension();
                $name = basename($request->image->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;
                $request->image->move('images/products-images/', $name);
            }
            $product->create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'price' => $request->price,
                'product_code' => $request->product_code,
                'size1' => $request->size1,
                'size2' => $request->size2,
                'size3' => $request->size3,
                'size4' => $request->size4,
                'image' => 'products-images/' . $name
            ]);
            return response()->json(['status' => 'success', 'msg' => $request->name . " Product Created Successfully!!"]);
            // } catch (\Throwable $th) {
            //     return response()->json(['status' => 'failed', 'msg' => "error created Product"]);
            // }
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
            $data = Product::findOrFail($id);
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
        $product = Product::findOrFail($id);
        if ($request->name) {
            $product->name = 'null';
            $product->save();
        }
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|unique:products|max:25',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'price' => 'required|max:11',
            'product_code' => 'required|max:11',
            'size1' => 'required|max:25',
            'size2' => 'required|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $filename = $product->image;
                    if (!$filename == null) {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        unlink($file_path);
                    }
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/products-images/', $name);
                }
                $product->update([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'product_code' => $request->product_code,
                    'size1' => $request->size1,
                    'size2' => $request->size2,
                    'image' => 'products-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Product updated Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error updated Product"]);
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
        $product = Product::findOrFail($id);
        $filename = $product->image;
        if (!$filename == null) {
            $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
            unlink($file_path);
        }
        if ($product->delete()) {
            return response()->json(['status' => 'success', 'msg' => $product->name . " Product Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function getProductByCategory(Request $request)
    {


        $category_id = $request['category_id'];

        $data = DB::table('products')
            ->where('category_id', $category_id)
            ->OrWhere('sub_category_id', $category_id)
            ->orderBy('created_at', 'desc')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        }



        return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
    }

    public function test()
    {
        // $product = Product::
        // whereIn('id', [1, 6])->update([
        //     'stock_status' => 1
        // ]);
        // return $product;
        // $apiConsumer = User::find(1);
        // $token = JWTAuth::fromUser($apiConsumer);
        // return $token;
        // ['exp' => Carbon\Carbon::now()->addYears(20)->timestamp]
        return Carbon\Carbon::now()->addYears(20)->timestamp;
    }
}
