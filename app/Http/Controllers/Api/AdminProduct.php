<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;
use Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class AdminProduct extends Controller
{
    public function store(Request $request)
    {
        $rules =
            [
                'cat_name' => "required",
                'category_id' => "required",
                'name' => "required",
                'price' => "required",
                'price2' => "required",
                'product_code' => "required",
                'description' => "required",
                'size1' => "required",
                'size2' => "required",
                'image' => "required",

            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes())
        {

            if ($request->hasFile('image'))
            {
                $extension = "." . $request->image->getClientOriginalExtension();
                $name = basename($request->image->getClientOriginalName(), $extension) . time();
                $name1 = $name . $extension;
                $request->image->move('public/product-images', $name1);
            }

            $category_name = $request->cat_name;
            $exits = DB::table('categories')->where('name', $category_name)->first();
            if ($exits) {
                $id = $exits->id;
                $inserteed = DB::table('products')->insert([
                    'cat_name' => $request->cat_name,
                    'category_id' => $id,
                    'name' => $request->name,
                    'price1' => $request->price,
                    'price2' => $request->price2,
                    'product_code' => $request->product_code,
                    'description' => $request->description,
                    'size1' => $request->size1,
                    'size2' => $request->size2,
                    'image' => 'product-image/' . $name1
                ]);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'category does not exist']);
            }

            if ($inserteed) {
                return response()->json(['status' => 'success', 'message' => 'added successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'error occured']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function getCategory(Request $request)
    {
        $get_category = DB::table('categories')->get();
        return view('add-menu-item', compact('get_category'));
    }

    public function geteditCategory(Request $request)
    {
        $edit_category = DB::table('categories')->get();
        return view('edit-product', compact('edit_category'));
    }

    public function getEditProductById(Request $request, $id)
    {
        $edit_product = DB::table('products')->where('id', $id)->first();
        if ($edit_product) {
            return response()->json(['status' => 'success', 'data' => $edit_product]);
        } else {
            return response()->json(['status' => 'success', 'message' => 'no data found']);
        }
    }

    public function View(Request $request)
    {
        $product_all = DB::table('products')->get();
        if (sizeof($product_all)>0) {
            return response()->json(['status' => 'success', 'data' => $product_all]);
        } else {
            return response()->json(['status' => 'failed', 'data' => 'no data found']);
        }
    }

    public function getsauce()
    {
        $get_sauce = DB::table('sauces')->get();
        if (sizeof($get_sauce)>0) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_sauce]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    public function addSauce(Request $req)
    {
        $rules =
            [
                'name' => "required",
                'sauce_price' => "required",


            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $addSauce = DB::table('toppings')->insert([
                'sauce' => $req->name,
                'sauce_price' => $req->sauce_price
            ]);
            if ($addSauce) {
                return response()->json(['status' => 'success', 'message' => 'added successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'no added error occured']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if ($product) {
            if ($request->hasFile('image')) {
                $filename = $product->image;
                if (!$filename == null) {
                    // $file_path = rtrim(app()->basePath('storage/' . 'app/' . 'public/' . $filename));
                        // dd($filename);
                    // unlink(storage_path('public/public/' . $filename));
                        // dd($filename);
                    // Storage::delete('public/products-images/delete.jpg');

                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = 'product-images/' . $name . $extension;
                    $name2 = $name . $extension;
                    $request->image->move('public/product-images', $name2);
                } else {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = 'product-images/' . $name . $extension;
                    $name2 = $name . $extension;
                    $request->image->move('public/product-images', $name2);
                }
            } else {
                $filename = $product->image;
                $name1 = $filename;
            }
            $data = DB::table('products')->where('id', $id)->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price1' => $request->price,
                'price2' => $request->price2,
                'product_code' => $request->product_code,
                'size1' => $request->size1,
                'size2' => $request->size2,
                'image' => $name1
            ]);
            if ($data == "1") {
                return response()->json(['status' => 'success', 'message' => 'updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'not updated']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'product does not exist']);
        }
    }

    public function addDippingSauce(Request $req)
    {
        $rules =
            [
                'name' => "required",
                'price' => "required",
                'image' => "required"

            ];

        $validator = Validator::make($req->all(), $rules);
        if ($validator->passes()) {

            $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

            $imageupload = $req->file('image');
            $extension = $imageupload->extension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $extension = "." . $req->image->getClientOriginalExtension();
                $name = basename($req->image->getClientOriginalName(), $extension) . time();
                $name1 = $name . $extension;
                $req->image->move('public/sauce-images', $name1);
            } else {
                return back()->with('message', 'file should be image');
            }
            $addDippingSauce = DB::table('sauces')->insert([
                'name' => $req->name,
                'image' => 'sauce-images/' . $name1,
                'price' => $req->price,
                'created_at' => Carbon::now()
            ]);
            if ($addDippingSauce) {
                return response()->json(['status' => 'success', 'message' => 'successfully Added']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'not Added']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    ////////////////////////
    public function deleteCategory($id)
    {
        $find_id = DB::table('categories')->where('id', $id)->first();
        if ($find_id) {
            // $cat_image = $find_id->image;
            // if (!$cat_image == null) {
            //     unlink(storage_path('app/public/' . $cat_image));
            // } else {
            //     // do nothing
            // }
            $Delete_category = DB::table('categories')->where('id', $id)->delete();
            if ($Delete_category == "1") {
                $Delete_category = DB::table('products')->where('category_id', $id)->delete();
                return  response()->json(['status' => 'success', 'message' => 'deleted successfully']);
            } else {
                return  response()->json(['status' => 'failed', 'message' => 'not deleted try again']);
            }
        } else {
            return  response()->json(['status' => 'failed', 'message' => 'data not found']);
        }
    }

    public function deleteProduct($id)
    {
        $find_id = DB::table('products')->where('id', $id)->first();
        if ($find_id) {
            // $product_image = $find_id->image;
            // if (!$product_image == null) {
            //     unlink(storage_path('app/public/' . $product_image));
            // } else {
            //     // do nothing
            // }
            $Delete_product = DB::table('products')->where('id', $id)->delete();
            if ($Delete_product) {
                return response()->json(['message', 'data deleted successfully']);
            } else {
                return response()->json(['message', 'could not be deleted try again']);
            }
        } else {
            return  response()->json(['status' => 'failed', 'message' => 'data not found']);
        }
    }

    public function deleteSauce($id)
    {
        $find_id = DB::table('sauces')->where('id', $id)->first();
        if ($find_id) {
            // $image = $find_id->image;
            // if (!$image == null) {
            //     unlink(storage_path('app/public/' . $image));
            // } else {
            //     // do nothing
            // }
            $Delete_sauce = DB::table('sauces')->where('id', $id)->delete();
            if ($Delete_sauce == "1") {
                return  response()->json(['status' => 'success', 'message' => 'deleted successfully']);
            } else {
                return  response()->json(['status' => 'failed', 'message' => 'could not be deleted']);
            }
        } else {
            return  response()->json(['status' => 'failed', 'message' => 'data not found']);
        }
    }

    public function EditD_sauce(Request $request, $id)
    {
        $find_id = DB::table('sauces')->where('id', $id)->first();
        if ($find_id) {
            $filename = $find_id->image;
            if ($request->hasFile('image')) {
                if (!$filename == null) {
                    // unlink(storage_path('app/public/' . $filename));
                }
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $uploadfile = '/' . time() . '.' . $imageupload->extension();
                    $request->image->move('public/sauce-images', $uploadfile);
                } else {
                    return response()->json(['message', 'file should be image']);
                }
                $update_sauce = DB::table('sauces')->where('id', $id)->update([
                    'name' => $request->name,
                    'image' => 'sauce-images' . $uploadfile,
                    'price' => $request->price
                ]);
                if ($update_sauce == "1") {
                    return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'could not be updated try again']);
                }
            } else {
                $update_sauce = DB::table('sauces')->where('id', $id)->update([
                    'name' => $request->name,
                    'price' => $request->price
                ]);
                if ($update_sauce == "1") {
                    return response()->json(['status' => 'success', 'message' => 'data updated successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'could not be updated try again']);
                }
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'NO Data Found']);
        }
    }

    public function getTopping(Request $request)
    {
        $get_toppings = DB::table('toppings')->get(['id', 'regular_toppings', 'regular_topping_price']);
        if ($get_toppings) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_toppings]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    public function AddToppings(Request $request)
    {
        $rules =
            [
                'name' => "required",
                'price' => "required",

            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $addTopping = DB::table('toppings')->insert([
                'regular_toppings' => $request['name'],
                'regular_topping_price' => $request['price'],
            ]);
            if ($addTopping) {
                return response()->json(['status' => 'success', 'message' => 'toppings added successfully']);
            } else {
                return response()->json(['status' => 'Failed', 'message' => 'Try again']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function editToppings(Request $request, $id)
    {
        $find_id = DB::table('toppings')->where('id', $id)->get();
        if ($find_id) {
            $update_topping = DB::table('toppings')->where('id', $id)->update([
                'regular_toppings' => $request->name,
                'regular_topping_price' => $request->price
            ]);
            if ($update_topping) {
                return response()->json(['status' => 'success', 'message' => 'updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Try Again']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data Found']);
        }
    }

    public function getCatByid($id)
    {
        $get_category = DB::table('categories')->where('id', $id)->get();
        if ($get_category) {
            return response()->json(['status' => 'success', 'data' => $get_category]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    public function getToppingByid($id)
    {
        $get_topping = DB::table('toppings')->where('id', $id)->get();
        if ($get_topping) {
            return response()->json(['status' => 'success', 'data' => $get_topping]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    public function getSauceByid($id)
    {
        $get_topping = DB::table('sauces')->where('id', $id)->get();
        if ($get_topping) {
            return response()->json(['status' => 'success', 'data' => $get_topping]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    // Delete Toppings
    public function DeleteToppingByid($id)
    {
        $get_topping = DB::table('toppings')->where('id', $id)->first();
        if ($get_topping == true) {
            $delete_topping = DB::table('toppings')->where('id', $id)->delete();
            if ($delete_topping) {
                return response()->json(['status' => 'success', 'message' => 'deleted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error Occured']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    ////////////// crust api
    public function addcrust(Request $request)
    {
        $rules =
            [
                'name' => "required",
                'price' => "required",
                'image' => "required"

            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            if ($request->hasFile('image')) {
                $extension = "." . $request->image->getClientOriginalExtension();
                $name = basename($request->image->getClientOriginalName(), $extension) . time();
                $name1 = $name . $extension;
                $request->image->move('public/crust-images', $name1);
            } else {

                $name1 = NULL;
            }

            $addcrust = DB::table('crust')->insert([
                'name' => $request->name,
                'price' => $request->price,
                'image' => 'crust-images/' . $name1
            ]);
            if ($addcrust = "true") {
                return response()->json(['status' => 'success', 'message' => 'added successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'not added']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function DeleteCheese($id)
    {
        $find_id = DB::table('cheese')->where('id', $id)->first();
        if ($find_id) {
            // $image = $find_id->image;
            // if (!$image == null) {
            //     unlink(storage_path('app/public/' . $image));
            // } else {
            //     // do nothing
            // }
            $del_cheese = DB::table('cheese')->where('id', $id)->delete();
            if ($del_cheese == "1") {
                return response()->json(['status' => 'success', 'message' => 'deleted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Try Again']);
            }
        }
    }

    public function editCrust(Request $request, $id)
    {
        $editcrust = DB::table('crust')->where('id', $id)->first();
        $filename = $editcrust->image;
        if ($request->hasFile('image')) {
            if (!$filename == null) {
                // unlink(storage_path('app/public/' . $filename));

                // $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $uploadfile = '/' . time() . '.' . $imageupload->extension();
                    $request->image->move('public/crust-images', $uploadfile);
                } else {
                    return response()->json(['message', 'file should be image']);
                }
            } else {
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $uploadfile = '/' . time() . '.' . $imageupload->extension();
                    $request->image->move('public/crust-images', $uploadfile);
                } else {
                    return response()->json('message', 'file should be image');
                }
            }
            if ($editcrust) {
                $editCrust = DB::table('crust')->where('id', $id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'image' => 'crust-images' . $uploadfile,
                ]);
                if ($editCrust == "1") {
                    return response()->json(['status' => 'success', 'message' => 'succesfully Edited']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'try again']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'no data found']);
            }
        } else {
            if ($editcrust) {
                $editCrust = DB::table('crust')->where('id', $id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                ]);
                if ($editCrust == "1") {
                    return response()->json(['status' => 'success', 'message' => 'succesfully Edited']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'try again']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'no data found']);
            }
        }
    }

    public function Getcrust()
    {
        $get_crust = DB::table('crust')->get();
        if (sizeof($get_crust) > 0) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_crust]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    public function getCrustByid(Request $request, $id)
    {
        $find_crust_by_id = DB::table('crust')->where('id', $id)->exists();
        if ($find_crust_by_id == "true") {
            $get_crust_by_id = DB::table('crust')->where('id', $id)->get();

            return response()->json(['status' => 'success', 'message' => 'data fetched successfulyy', 'data' => $get_crust_by_id]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'no data found']);
        }
    }

    public function EditCheese(Request $req, $id)
    {
        $find_id = DB::table('cheese')->where('id', $id)->first();
        if ($find_id) {
            $filename = $find_id->cheese_image;
            if ($req->hasFile('image')) {
                if (!$filename == null) {
                    // unlink(storage_path('app/public/' . $filename));

                    $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                    $imageupload = $req->file('image');
                    $extension = $imageupload->extension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $uploadfile = '/' . time() . '.' . $imageupload->extension();
                        $req->image->move('public/cheese-images', $uploadfile);
                    } else {
                        return response()->json('message', 'file should be image');
                    }
                } else {
                    $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                    $imageupload = $req->file('image');
                    $extension = $imageupload->extension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $uploadfile = '/' . time() . '.' . $imageupload->extension();
                        $req->image->move('public/cheese-images', $uploadfile);
                    } else {
                        return response()->json('message', 'file should be image');
                    }
                }
                $editCheese = DB::table('cheese')->where('id', $id)->update([
                    'cheese_price' => $req->price,
                    'cheese_name' => $req->name,
                    'cheese_image' => 'cheese-images' . $uploadfile
                ]);
                if ($editCheese == "1") {
                    return response()->json(['status' => 'success', 'message' => 'succesfully Edited']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'try again']);
                }
            } else {
                $editCheese = DB::table('cheese')->where('id', $id)->update([
                    'cheese_price' => $req->price,
                    'cheese_name' => $req->name,
                ]);
                if ($editCheese == "1") {
                    return response()->json(['status' => 'success', 'message' => 'succesfully Edited']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'try again']);
                }
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }

    /// Add cheese
    public function AddCheese(Request $req)
    {
        $rules =
            [
                'cheese_price' => "required",
                'cheese_size' => "required",
                'name' => "required",
                'image' => "required"

            ];

        $validator = Validator::make($req->all(), $rules);
        if ($validator->passes()) {
            if ($req->hasFile('image')) {
                $extension = "." . $req->image->getClientOriginalExtension();
                $name = basename($req->image->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;
                $req->image->move('public/cheese-images', $name);

                $addCheese = DB::table('cheese')->insert([
                    'cheese_price' => $req->cheese_price,
                    'cheese' => $req->cheese_size,
                    'cheese_image' => 'cheese-images/' . $name,
                    'cheese_name' => $req->name
                ]);
            }


            if ($addCheese) {
                return response()->json(['status' => 'success', 'message' => 'succesfully Added']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'not added']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function getCheese()
    {
        $all_cheese = DB::table('cheese')->get();
        if (sizeof($all_cheese) > 0) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $all_cheese]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    public function getCheeseByid($id)
    {
        $get_cheese = DB::table('cheese')->where('id', $id)->get(['id', 'cheese', 'cheese_price', 'cheese_image', 'cheese_name']);
        if ($get_cheese) {
            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_cheese]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    public function DeleteCrust($id)
    {
        $find_id = DB::table('crust')->where('id', $id)->first();
        if ($find_id) {
            // $image = $find_id->image;
            // if (!$image == null) {
            //     unlink(storage_path('app/public/' . $image));
            // } else {
            //     // do nothing
            // }
            $del_crust = DB::table('crust')->where('id', $id)->delete();
            if ($del_crust == "1") {
                return response()->json(['status' => 'success', 'message' => 'deleted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Try Again']);
            }
        }
    }

    ///// Add Pizza In product
    public function AddPizza(Request $request)
    {z
        $rules = [
            'cat_name' => "required",
            'name' => "required",
            'cheese' => "required",
            'sauce' => "required",
            // 'topping'=>"required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            if ($request->hasFile('image')) {
                $extension = $request['image']->extension();
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];
                $check = in_array($extension, $allowedfileExtension);

                if ($check) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = $name . $extension;
                    $request->image->storeAs('public/pizza-images', $name1);
                } else {

                    return response()->json(['status' => 'failed', 'message' => 'file should be image ']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'image is required']);
            }
            $category_name = $request->cat_name;
            $exits = DB::table('categories')->where('name', $category_name)->first();
            if ($exits) {
                $id = $exits->id;
            } else {
                return response()->json(['status' => 'failed', 'message' => 'category not found']);
            }

            dd($request->all());

            $add_pizza = DB::table('products')->insert([
                'category_id' => $id,
                'cat_name' => $request->cat_name,
                'name' => $request->name,
                'image' => 'pizza-images' . '/' . $name1,
                'description' => $request->description,
                'quntity' => $request->quantity,
                'price1' => $request->price1,
                'price2' => $request->price2,
                'size1' => $request->size1,
                'cheese' => $request->cheese,
                'cheese_price' => $request->cheese_price,
                'sauce' => $request->sauce,
                'sauce_price' => $request->sauce_price,
                'topping' => $request->topping,
                'topping_price' => $request->topping_price,
                'product_code' => $request->product_code,
                'dough_price1' => $request->dough_price1,
                'dough_price2' => $request->dough_price2
            ]);
            if ($add_pizza) {
                return response()->json(['status' => 'success', 'message' => 'inserted successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Not inserted try again']);
            }
        } else {
            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    // get category for list
    public function getCategoryForPizza(Request $request)
    {
        $get_category_list = DB::table('categories')->get();
        return view('add-pizza', compact('get_category_list'));
    }

    ////
    public function editPizza(Request $request, $id)
    {
        $find_pizza_id = DB::table('products')->where('id', $id)->first();
        if ($find_pizza_id) {
            $filename = $find_pizza_id->image;
            if ($request->hasFile('image')) {
                if (!$filename == null) {
                    // unlink(storage_path('app/public/' . $filename));
                    $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                    $imageupload = $request->file('image');
                    $extension = $imageupload->extension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $extension = "." . $request->image->getClientOriginalExtension();
                        $name = basename($request->image->getClientOriginalName(), $extension) . time();
                        $name1 = $name . $extension;
                        $request->image->move('public/pizza-images', $name1);
                    } else {
                        return response()->json(['status' => 'failed', 'message' => 'file should be image']);
                    }
                    $edit = DB::table('products')->where('id', $id)->update(
                        [
                            'name' => $request->name,
                            'image' => '/pizza-images' . '/' . $name1,
                            'description' => $request->description,
                            'quntity' => $request->quantity,
                            'price1' => $request->price1,
                            'price2' => $request->price2,
                            'size1' => $request->size1,
                            'cheese' => $request->cheese,
                            'cheese_price' => $request->cheese_price,
                            'sauce' => $request->sauce,
                            'sauce_price' => $request->sauce_price,
                            'topping' => $request->topping,
                            'topping_price' => $request->topping_price,
                            'dough_price1' => $request->dough_price1,
                            'dough_price2' => $request->dough_price2
                        ]
                    );
                    if ($edit) {

                        return response()->json(['status' => 'success', 'message' => 'successfully Updated']);
                    } else {

                        return response()->json(['status' => 'failed', 'message' => 'error Ocurred']);
                    }
                }
            } else {

                $edit = DB::table('products')->where('id', $id)->update(
                    [
                        'name' => $request->name,
                        'quntity' => $request->quantity,
                        'price1' => $request->price1,
                        'price2' => $request->price2,
                        'size1' => $request->size1,
                        'cheese' => $request->cheese,
                        'cheese_price' => $request->cheese_price,
                        'sauce' => $request->sauce,
                        'sauce_price' => $request->sauce_price,
                        'topping' => $request->topping,
                        'topping_price' => $request->topping_price,
                        'product_code' => $request->product_code,
                        'dough_price1' => $request->dough_price1,
                        'dough_price2' => $request->dough_price2
                    ]
                );
                if ($edit) {

                    return response()->json(['status' => 'success', 'message' => 'successfully Updated']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'error Ocurred']);
                }
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }

    public function getEditPizza(Request $request, $id)
    {
        $get_id = DB::table('products')->where('id', $id)->get();
        if (sizeof($get_id) > 0) {
            $get_data = DB::table('products')->where('id', $id)->get();
            return response()->json(['status' => 'success', 'message' => 'data found successfully', 'data' => $get_data]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    public function Get_pizza(Request $request)
    {
        $get_data = DB::table('products')->where('cat_name', 'pizza')->get();
        if (sizeof($get_data) > 0) {
            return response()->json(['status' => 'success', 'message' => 'data successfully fetched', 'data' => $get_data]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    // delete pizza
    public function deletePizza($id)
    {
        $delete_pizza = DB::table('products')->where('id', $id)->exists();
        if ($delete_pizza == "true") {
            $find_pizza_id = DB::table('products')->where('id', $id)->first();
            // $filename = $find_pizza_id->image;
            // if (!$filename == null) {
            //     unlink(storage_path('app/public/' . $filename));
            // } else {
            // }
            $deleted_product = DB::table('products')->where('id', $id)->delete();
            if ($deleted_product == 1) {

                return response()->json(['status' => 'success', 'message' => 'Product Deleted Successfully']);
            } else {

                return response()->json(['status' => 'failed', 'message' => 'Not Deleted Try Again']);
            }
        } else {

            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }

    /// Add special pizza
    public function addSpecialPizza(Request $request)
    {
        $rules =
            [
                'cat_name' => "required",
                'name' => "required",
                'cheese' => "required",
                'cheese_price' => "required",
                'sauce' => "required",
                'sauce_price' => "required",
                'topping' => "required",
                'topping_price' => "required",
            ];
        if ($request->hasFile('image')) {
            $extension = $request['image']->extension();
            $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];
            $check = in_array($extension, $allowedfileExtension);

            if ($check) {
                $extension = "." . $request->image->getClientOriginalExtension();
                $name = basename($request->image->getClientOriginalName(), $extension) . time();
                $name1 = $name . $extension;
                $request->image->move('public/pizza-images', $name1);
            } else {

                return response()->json(['status' => 'failed', 'message' => 'file should be image ']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'image is required']);
        }
        $category_name = $request->cat_name;
        $exits = DB::table('categories')->where('name', $category_name)->first();
        if ($exits) {
            $id = $exits->id;
        } else {
            return response()->json(['status' => 'failed', 'message' => 'category not found']);
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $add_s_pizza = DB::table('s_pizza')->insert(
                [
                    'category_id' => $request->Category_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'cat_name' => $request->cat_name,
                    'image' => '/pizza-images' . '/' . $name1,
                    'quntity' => $request->quantity,
                    'price1' => $request->price1,
                    'price2' => $request->price2,
                    'size1' => $request->size1,
                    'cheese' => $request->cheese,
                    'cheese_price' => $request->cheese_price,
                    'sauce' => $request->sauce,
                    'sauce_price' => $request->sauce_price,
                    'topping' => $request->topping,
                    'topping_price' => $request->topping_price,
                    'dough_price1' => $request->dough_price1,
                    'dough_price2' => $request->dough_price2
                ]
            );

            if ($add_s_pizza) {
                return response()->json(['status' => 'success', 'message' => 'inserted successfully']);
            } else {

                return response()->json(['status' => 'failed', 'message' => 'Not inserted try again']);
            }
        } else {

            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }

    public function editSpecailPizza(Request $request, $id)
    {
        $find_pizza_id = DB::table('s_pizza')->where('id', $id)->first();
        $filename = $find_pizza_id->image;

        if ($request->hasFile('image')) {
            if (!$filename == null) {
                // unlink(storage_path('app/public/' . $filename));
                $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg', 'gif', 'tiff', 'webp'];

                $imageupload = $request->file('image');
                $extension = $imageupload->extension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = $name . $extension;
                    $request->image->move('public/pizza-images', $name1);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'file should be image']);
                }
                $edit = DB::table('s_pizza')->where('id', $id)->update(
                    [
                        'name' => $request->name,
                        'image' => '/pizza-images' . '/' . $name1,
                        'quntity' => $request->quantity,
                        'price1' => $request->price1,
                        'price2' => $request->price2,
                        'size1' => $request->size1,
                        'cheese' => $request->cheese,
                        'cheese_price' => $request->cheese_price,
                        'sauce' => $request->sauce,
                        'sauce_price' => $request->sauce_price,
                        'topping' => $request->topping,
                        'topping_price' => $request->topping_price,
                        'dough_price1' => $request->dough_price1,
                        'dough_price2' => $request->dough_price2
                    ]
                );
                if ($edit) {

                    return response()->json(['status' => 'success', 'message' => 'successfully Updated']);
                } else {

                    return response()->json(['status' => 'failed', 'message' => 'error Ocurred']);
                }
            }
        } else {

            $edit = DB::table('s_pizza')->where('id', $id)->update(
                [
                    'name' => $request->name,
                    'quntity' => $request->quantity,
                    'price1' => $request->price1,
                    'price2' => $request->price2,
                    'size1' => $request->size1,
                    'cheese' => $request->cheese,
                    'cheese_price' => $request->cheese_price,
                    'sauce' => $request->sauce,
                    'sauce_price' => $request->sauce_price,
                    'topping' => $request->topping,
                    'topping_price' => $request->topping_price,
                    'dough_price1' => $request->dough_price1,
                    'dough_price2' => $request->dough_price2
                ]
            );
            if ($edit) {

                return response()->json(['status' => 'success', 'message' => 'successfully Updated']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'error Ocurred']);
            }
        }
    }

    public function getSpecialPizza()
    {
        $get_s_pizza = DB::table('s_pizza')->get();
        if (sizeof($get_s_pizza) > 0) {
            return response()->json(['status' => 'success', 'message' => 'Data Fetched Successfully', 'data' => $get_s_pizza]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
        }
    }

    /// delete special pizza
    public function deleteSpecialPizza($id)
    {
        $find_id = DB::table('s_pizza')->where('id', $id)->exists();
        if ($find_id == "true") {
            $find_s_pizza_id = DB::table('s_pizza')->where('id', $id)->first();
            $filename = $find_s_pizza_id->image;

            // if (!$filename == null) {
            //     unlink(storage_path('app/public/' . $filename));
            // } else {
            // }
            $delete_s_pizza = DB::table('s_pizza')->where('id', $id)->delete();
            if ($delete_s_pizza == 1) {

                return response()->json(['status' => 'success', 'message' => 'Deleted successfully']);
            } else {

                return response()->json(['status' => 'failed', 'meesage' => 'Not Deleted ']);
            }
        } else {

            return response()->json(['status' => 'failed', 'meesage' => 'No Data Found']);
        }
    }

    /////build your own pizza
    // public function BuildYourOwn(Request $request)
    // {
    //     $rules =
    //         [
    //             'cheese' => "required",
    //             'cheese_price' => "required",
    //             'sauce' => "required",
    //             'sauce_price' => "required",
    //             'topping' => "required",
    //             'topping_price' => "required",
    //         ];
    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->passes()) {

    //         $add_s_pizza = DB::table('ownpizza')->insertGetId(
    //             [
    //                 'price1' => $request->price1,
    //                 'price2' => $request->price2,
    //                 'cheese' => $request->cheese,
    //                 'cheese_price' => $request->cheese_price,
    //                 'sauce' => $request->sauce,
    //                 'sauce_price' => $request->sauce_price,
    //                 'topping' => $request->topping,
    //                 'topping_price' => $request->topping_price,
    //                 'dough_price1' => $request->dough_price1,
    //                 'dough_price2' => $request->dough_price2,
    //                 'topping_price' => $request->topping_price,
    //                 'topping_price_half' => $request->topping_price_half,
    //                 'half_price' => $request->half_price,
    //                 'full_price' => $request->full_price
    //             ]
    //         );

    //         if ($add_s_pizza) {

    //             return response()->json(['status' => 'success', 'message' => 'inserted successfully']);
    //         } else {

    //             return response()->json(['status' => 'failed', 'message' => 'Not inserted try again']);
    //         }
    //     } else {

    //         $errors = $validator->errors();
    //         return response()->json(['status' => 'failed', 'error' => $errors]);
    //     }
    // }

    public function getYourOwnPizza(Request $request)
    {
        $get_pizza = DB::table('ownpizza')->get();
        if (sizeof($get_pizza) > 0) {

            return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $get_pizza]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'error occured']);
        }
    }

    // public function delete_your_Pizza(Request $request, $id)
    // {
    //     if (isset($request['id']) && !empty($request['id'])) {
    //         $id = $request->id;
    //         $get_id = DB::table('ownpizza')->where('id', $id)->exists();
    //         if ($get_id == "true") {
    //             $delete_pizza = DB::table('ownpizza')->where('id', $id)->delete();

    //             if ($delete_pizza) {
    //                 return response()->json(['status' => 'success', 'message' => 'deleted Successfully']);
    //             } else {
    //                 return response()->json(['status' => 'failed', 'message' => 'Not deleted']);
    //             }
    //         } else {
    //             return response()->json(['status' => 'failed', 'message' => 'No data found']);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'Incomplete Params']);
    //     }
    // }

    public function add_build_pizza()
    {
        return view('add-build-pizza');
    }

    public function addhalf_build_pizza()
    {
        return view('add-half-pizza');
    }

    public function get_own_build(Request $request)
    {
        $get_data = DB::table('ownpizza')->get();
        if ($get_data) {
            return response()->json(['status' => 'success', 'message' => 'data feteched successfully', 'data' => $get_data]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'No data found']);
        }
    }

    public function EditOWn_get()
    {
        return view('edit-build-pizza');
    }

    public function get_own_piza()
    {
        return view('view-own-pizza');
    }

    public function editYour_own_Pizza(Request $request, $id)
    {
        if (isset($request['id']) && !empty($request['id'])) {
            $id = $request->id;
            $find_pizza_id = DB::table('ownpizza')->where('id', $id)->first();
            if ($find_pizza_id) {
                $edit = DB::table('ownpizza')->where('id', $id)->update(
                    [

                        'price1' => $request->price1,
                        'price2' => $request->price2,
                    ]
                );
                if ($edit) {

                    return response()->json(['status' => 'success', 'message' => 'successfully Updated']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'error Ocurred']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'No Data Found']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Incomplete Params']);
        }
    }

    public function getEditdata(Request $request, $id)
    {
        $get_id = DB::table('ownpizza')->where('id', $id)->exists();
        if ($get_id == "true") {
            $edit_get = DB::table('ownpizza')->where('id', $id)->get();
            if (sizeof($edit_get) > 0) {
                return response()->json(['status' => 'success', 'message' => 'data fetched successfully', 'data' => $edit_get]);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'No data fetched']);
            }
        } else {
            return response()->json(['status' => 'success', 'message' => 'no data found']);
        }
    }

    public function edit_your_own_pizza(Request $request, $id)
    {
        $rules =
            [
                'dough_price1' => "required",
                'dough_price2' => "required",
                'no_cheese_price_12' => "required",
                'less_cheeses_price_12' => "required",
                'normal_cheese_price_12' => "required",
                'no_cheese_price_18' => "required",
                'less_cheeses_price_18' => "required",
                'normal_cheese_price_18' => "required",
                'rebust_price_12' => "required",
                'honey_BBQ_price_12' => "required",
                'ranch_price_12' => "required",
                'none_sauce_price_12' => "required",
                'ranch_price_12' => "required",
                'rebust_price_18' => "required",
                'honey_BBQ_price_18' => "required",
                'ranch_price_18' => "required",
                'none_sauce_price_18' => "required",
                'toppng_full_1_12_price' => "required",
                'toppng_full_2_12_price' => "required",
                'toppng_full_3_12_price' => "required",
                'toppng_full_4__12_price' => "required",
                'toppng_full_1_18_price' => "required",
                'toppng_full_2_18_price' => "required",
                'toppng_full_3_18_price' => "required",
                'toppng_full_4_18_price' => "required",
                'topping_half_1_12' => "required",
                'topping_half_2_12' => "required",
                'topping_half_3_12' => "required",
                'topping_half_4_12' => "required",
                'topping_half_1_18' => "required",
                'topping_half_2_18' => "required",
                'topping_half_3_18' => "required",
                'topping_half_4_18' => "required"
            ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $edit_own_pizza = DB::table('ownpizza')->where('id', $request->id)->update([
                'dough_price1' => $request->dough_price1,
                'dough_price2' => $request->dough_price2,
                'no_cheese_price_12' => $request->no_cheese_price_12,
                'less_cheeses_price_12' => $request->less_cheeses_price_12,
                'normal_cheese_price_12' => $request->normal_cheese_price_12,
                'no_cheese_price_18' => $request->no_cheese_price_18,
                'less_cheeses_price_18' => $request->less_cheeses_price_18,
                'normal_cheese_price_18' => $request->normal_cheese_price_18,
                'rebust_price_12' => $request->rebust_price_12,
                'honey_BBQ_price_12' => $request->honey_BBQ_price_12,
                'ranch_price_12' => $request->ranch_price_12,
                'none_sauce_price_12' => $request->none_sauce_price_12,
                'ranch_price_12' => $request->ranch_price_12,
                'rebust_price_18' => $request->rebust_price_18,
                'honey_BBQ_price_18' => $request->honey_BBQ_price_18,
                'ranch_price_18' => $request->ranch_price_18,
                'none_sauce_price_18' => $request->none_sauce_price_18,
                'toppng_full_1_12_price' => $request->toppng_full_1_12_price,
                'toppng_full_2_12_price' => $request->toppng_full_2_12_price,
                'toppng_full_3_12_price' => $request->toppng_full_3_12_price,
                'toppng_full_4__12_price' => $request->toppng_full_4__12_price,
                'toppng_full_1_18_price' => $request->toppng_full_1_18_price,
                'toppng_full_2_18_price' => $request->toppng_full_2_18_price,
                'toppng_full_3_18_price' => $request->toppng_full_3_18_price,
                'toppng_full_4_18_price' => $request->toppng_full_4_18_price,
                'topping_half_1_12' => $request->topping_half_1_12,
                'topping_half_2_12' => $request->topping_half_2_12,
                'topping_half_3_12' => $request->topping_half_3_12,
                'topping_half_4_12' => $request->topping_half_4_12,
                'topping_half_1_18' => $request->topping_half_1_18,
                'topping_half_2_18' => $request->topping_half_2_18,
                'topping_half_3_18' => $request->topping_half_3_18,
                'topping_half_4_18' => $request->topping_half_4_18
            ]);
            if ($edit_own_pizza) {
                return response()->json(['status' => 'success', 'message' => 'edited successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'not edited tru again']);
            }
        } else {

            $errors = $validator->errors();
            return response()->json(['status' => 'failed', 'error' => $errors]);
        }
    }
}
