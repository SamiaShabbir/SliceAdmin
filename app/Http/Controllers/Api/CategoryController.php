<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Category;
use App\Models\Api\SubCategories;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = Category::query();
            if (isset($request['parent']) && !empty($request['parent']) && is_numeric($request['parent'])) {
                $data = $data->where("parent_id", $request['parent']);
            } else {
                $data = $data->where("parent_id", 0);
            }
            $data = $data->orderBy("name", "ASC")->get();
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
    public function store(Request $request, Category $cat)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:20',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                if ($request->hasFile('image')) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name = $name . $extension;
                    $request->image->move('images/category-images/', $name);
                }
                $cat->create([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'image' => 'category-images/' . $name
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Category Created Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error created Category"]);
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
            $data = Category::findOrFail($id);
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
        $cat = Category::findOrFail($id);
        if ($request->name) {
            $cat->name = 'null';
            $cat->save();
        }
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            try {
                $cat->update([
                    'name' => $request->name,
                    'desc' => $request->desc
                ]);
                return response()->json(['status' => 'success', 'msg' => $request->name . " Category updated Successfully!!"]);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'failed', 'msg' => "error updated Category"]);
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
        $cat = Category::findOrFail($id);
        if ($cat->delete()) {
            return response()->json(['status' => 'success', 'msg' => $cat->name . " Category Deleted Successfully!!"]);
        } else {
            return response()->json(['status' => 'failed', 'msg' => "No Data Found!!"]);
        }
    }

    public function addSubCategory(Request $request)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_cat_name' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            $cat = new SubCategories();

            $cat->create([
                'category_id' => $request->category_id,
                'sub_cat_name' => $request->sub_cat_name
            ]);
            return response()->json(['status' => 'success', 'msg' => "Sub Category Created Successfully!!"]);
        }
    }

    public function getSubCategory(Request $request)
    {
        if (isset($request['category_id']) && !empty($request['category_id'])) {
            $get = DB::table('sub_categories')->where('category_id', $request->category_id)->get();
            return response()->json(['status' => 'success', 'messge' => "Subcategory fetched successfully!", 'data' => $get]);
        } else {
            return response()->json(['status' => 'failed', 'messge' => "Incomplete param!"]);
        }
    }
}
