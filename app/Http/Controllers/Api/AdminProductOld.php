      ////// Add Pizza In product
      public function AddPizza(Request $request)
      {
            $rules =
             [
                'cat_name' => "required",
                'name' => "required",
                'quantity'=>"required",
                'cheese'=>"required",
                'cheese_price'=>"required",
                'sauce'=>"required",
                'sauce_price'=>"required",
                'topping'=>"required",
                'topping_price'=>"required",
                'product_code'=>"required"
             ];
            if ($request->hasFile('image')) 
            {
                  $extension=$request['image']->extension();
                  $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
                  $check=in_array($extension,$allowedfileExtension);

                  if($check)
                  {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = $name . $extension;
                    $request->image->move('images/pizza-images/', $name1);
                  }
                  else
                  {

                   return response()->json(['status'=>'failed','message'=>'file should be image ']);
                  }
                }
                else
                {
                  return response()->json(['status'=>'failed','message'=>'image is required']);

                }
                    $validator = Validator::make($request->all(), $rules);

                    if ($validator->passes())     
                    {

                    $add_pizza=DB::table('products')->insert(
                    [
                    'category_id'=>$request->Category_id,
                    'name'=>$request->name,
                    'image'=>'/pizza-images'.'/'.$name1,
                    'quntity'=>$request->quantity,
                    'price1'=>$request->price1,
                    'price2'=>$request->price2,
                    'size1'=>$request->size1,
                    'cheese'=>$request->cheese,
                    'cheese_price'=>$request->cheese_price,
                    'sauce'=>$request->sauce,
                    'sauce_price'=>$request->sauce_price,
                    'topping'=>$request->topping,
                    'topping_price'=>$request->topping_price,
                    'product_code'=>$request->product_code,
                    'dough_price1'=>$request->dough_price1,
                    'dough_price2'=>$request->dough_price2
                    ]
                  );

                if($add_pizza)
                {
                 return response()->json(['status'=>'success','message'=>'inserted successfully']);

                }
                else
                {
             
                return response()->json(['status'=>'failed','message'=>'Not inserted try again']);

                }

            } 
            else 
            {

               $errors = $validator->errors();
               return response()->json(['status'=>'failed','error'=>$errors]);
 
            }
       
      }
       // edit pizza
            public function editPizza(Request $request)
            {
           if(isset($request['id']) && !empty($request['id']))
           {
             $find_pizza_id=DB::table('products')->where('id',$id)->first();
             $filename=$find_pizza_id->image;

             if($request->hasFile('image'))
             {
               if (!$filename == null) 
               {
                  $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                  File::delete($file_path);
                  $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
    
                  $imageupload=$request->file('image');
                  $extension=$imageupload->extension();
                  $check=in_array($extension,$allowedfileExtension);
                  if($check)
                  {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = $name . $extension;
                    $request->image->move('images/pizza-images/', $name1);
                  }
                  else
                  {
                     return response()->json(['status'=>'failed','message'=>'file should be image']);
                  }
                  $edit=DB::table('products')->where('id',$id)->update(
                [
                    'name'=>$request->name,
                    'image'=>'/pizza-images'.'/'.$name1,
                    'quntity'=>$request->quantity,
                    'price1'=>$request->price1,
                    'price2'=>$request->price2,
                    'size1'=>$request->size1,
                    'cheese'=>$request->cheese,
                    'cheese_price'=>$request->cheese_price,
                    'sauce'=>$request->sauce,
                    'sauce_price'=>$request->sauce_price,
                    'topping'=>$request->topping,
                    'topping_price'=>$request->topping_price,
                    'product_code'=>$request->product_code,
                    'dough_price1'=>$request->dough_price1,
                    'dough_price2'=>$request->dough_price2 
                ]
                );
             if($edit)
             {

              return response()->json(['status'=>'success','message'=>'successfully Updated']);
             } 
             else
             {

              return response()->json(['status'=>'failed','message'=>'error Ocurred']);
      
             }
              
             }
             }
             else
             {
      
              $edit=DB::table('products')->where('id',$id)->update(
                [
                    'name'=>$request->name,
                    'quntity'=>$request->quantity,
                    'price1'=>$request->price1,
                    'price2'=>$request->price2,
                    'size1'=>$request->size1,
                    'cheese'=>$request->cheese,
                    'cheese_price'=>$request->cheese_price,
                    'sauce'=>$request->sauce,
                    'sauce_price'=>$request->sauce_price,
                    'topping'=>$request->topping,
                    'topping_price'=>$request->topping_price,
                    'product_code'=>$request->product_code,
                    'dough_price1'=>$request->dough_price1,
                    'dough_price2'=>$request->dough_price2 
                ]
                );
                if($edit)
                  {

                    return response()->json(['status'=>'success','message'=>'successfully Updated']);
                  } 
                  else
                  {
                    return response()->json(['status'=>'failed','message'=>'error Ocurred']);
            
                  }             

             } 
            }
            else
            {
                    return response()->json(['status'=>'failed','message'=>'Incomplete Params']);
                     
            }
          
            } 
            public function Get_pizza(Request $request)
            {
               $get_data=DB::table('products')->where('cat_name','pizza')->get();
               if(sizeof($get_data) > 0)
               {
                return response()->json(['status'=>'success','message'=>'data successfully fetched','data'=>$get_data]);

               }
               else
               {
                return response()->json(['status'=>'failed','message'=>'No data found']);
                
               }

            }
            // delete pizza 
            public function deletePizza(Request $request)
            {
              if(isset($request['id']) && !empty($request['id']))
              {
              $id=$request->id;
                  $delete_pizza=DB::table('products')->where('id',$id)->exists();
                  if($delete_pizza=="true")
                  {
                    $find_pizza_id=DB::table('products')->where('id',$id)->first();
                    $filename=$find_pizza_id->image;

                      if (!$filename == null) 
                      {
                            $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                            File::delete($file_path);
                      }
                      else
                      {

                      }
                  $deleted_product=DB::table('products')->where('id',$id)->delete();
                      if($deleted_product==1)
                      {
                      
                        return response()->json(['status'=>'success','message'=>'Product Deleted Successfully']);
                      }
                      else
                      {

                        return response()->json(['status'=>'failed','message'=>'Not Deleted Try Again']);
                        
                      }
                  }
                  else
                  {

                    return response()->json(['status'=>'failed','message'=>'No Data Found']);

                  }
            }
            else
            {
                return response()->json(['status'=>'failed','message'=>'Incomplete Param']);
            }

            }
            
            /// Add special pizza
              public function addSpecialPizza(Request $request)
              {
                $rules =
                [
                    'cat_name' => "required",
                    'name' => "required",
                    'quantity'=>"required",
                    'cheese'=>"required",
                    'cheese_price'=>"required",
                    'sauce'=>"required",
                    'sauce_price'=>"required",
                    'topping'=>"required",
                    'topping_price'=>"required",
                ];
                if ($request->hasFile('image')) 
                {
                      $extension=$request['image']->extension();
                      $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
                      $check=in_array($extension,$allowedfileExtension);

                      if($check)
                      {
                        $extension = "." . $request->image->getClientOriginalExtension();
                        $name = basename($request->image->getClientOriginalName(), $extension) . time();
                        $name1 = $name . $extension;
                        $request->image->move('images/pizza-images/', $name1);
                      }
                      else
                      {

                      return response()->json(['status'=>'failed','message'=>'file should be image ']);
                      }
                    }
                    else
                    {
                      return response()->json(['status'=>'failed','message'=>'image is required']);

                    }
                        $validator = Validator::make($request->all(), $rules);

                        if ($validator->passes())     
                        {

                        $add_s_pizza=DB::table('s_pizza')->insert(
                        [
                        'category_id'=>$request->Category_id,
                        'name'=>$request->name,
                        'image'=>'/pizza-images'.'/'.$name1,
                        'quntity'=>$request->quantity,
                        'price1'=>$request->price1,
                        'price2'=>$request->price2,
                        'size1'=>$request->size1,
                        'cheese'=>$request->cheese,
                        'cheese_price'=>$request->cheese_price,
                        'sauce'=>$request->sauce,
                        'sauce_price'=>$request->sauce_price,
                        'topping'=>$request->topping,
                        'topping_price'=>$request->topping_price,
                        'dough_price1'=>$request->dough_price1,
                        'dough_price2'=>$request->dough_price2
                        ]
                      );

                    if($add_s_pizza)
                    {
                    return response()->json(['status'=>'success','message'=>'inserted successfully']);

                    }
                    else
                    {
                
                    return response()->json(['status'=>'failed','message'=>'Not inserted try again']);

                    }

                } 
                else 
                {

                  $errors = $validator->errors();
                  return response()->json(['status'=>'failed','error'=>$errors]);
    
                }
       
              }   

            public function editSpecailPizza(Request $request)
            {
             if(isset($request['id']) && !empty($request['id']))
             {
                $id=$request->id;
             
                  $find_pizza_id=DB::table('s_pizza')->where('id',$id)->first();
                  $filename=$find_pizza_id->image;

                  if($request->hasFile('image'))
                  {
                    if (!$filename == null) 
                    {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        File::delete($file_path);
                        $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
          
                        $imageupload=$request->file('image');
                        $extension=$imageupload->extension();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check)
                        {
                          $extension = "." . $request->image->getClientOriginalExtension();
                          $name = basename($request->image->getClientOriginalName(), $extension) . time();
                          $name1 = $name . $extension;
                          $request->image->move('images/pizza-images/', $name1);
                        }
                        else
                        {
                          return response()->json(['status'=>'failed','message'=>'file should be image']);
                        }
                        $edit=DB::table('s_pizza')->where('id',$id)->update(
                      [
                          'name'=>$request->name,
                          'image'=>'/pizza-images'.'/'.$name1,
                          'quntity'=>$request->quantity,
                          'price1'=>$request->price1,
                          'price2'=>$request->price2,
                          'size1'=>$request->size1,
                          'cheese'=>$request->cheese,
                          'cheese_price'=>$request->cheese_price,
                          'sauce'=>$request->sauce,
                          'sauce_price'=>$request->sauce_price,
                          'topping'=>$request->topping,
                          'topping_price'=>$request->topping_price,
                          'dough_price1'=>$request->dough_price1,
                          'dough_price2'=>$request->dough_price2 
                      ]
                      );
                  if($edit)
                  {

                    return response()->json(['status'=>'success','message'=>'successfully Updated']);

                  } 
                  else
                  {

                    return response()->json(['status'=>'failed','message'=>'error Ocurred']);
            
                  }
                    
                  }
                  }
                  else
                  {
            
                    $edit=DB::table('s_pizza')->where('id',$id)->update(
                      [
                          'name'=>$request->name,
                          'quntity'=>$request->quantity,
                          'price1'=>$request->price1,
                          'price2'=>$request->price2,
                          'size1'=>$request->size1,
                          'cheese'=>$request->cheese,
                          'cheese_price'=>$request->cheese_price,
                          'sauce'=>$request->sauce,
                          'sauce_price'=>$request->sauce_price,
                          'topping'=>$request->topping,
                          'topping_price'=>$request->topping_price,
                          'dough_price1'=>$request->dough_price1,
                          'dough_price2'=>$request->dough_price2 
                      ]
                      );
                      if($edit)
                        {

                          return response()->json(['status'=>'success','message'=>'successfully Updated']);
                        } 
                        else
                        {
                          return response()->json(['status'=>'failed','message'=>'error Ocurred']);
                  
                        }             

                  }  
                }
                else
                {

                  return response()->json(['status'=>'failed','message'=>'Incomplete Params']);
                }        
            } 
            public function getSpecialPizza()
            {
             $get_s_pizza=DB::table('s_pizza')->get();
             if(sizeof($get_s_pizza) > 0)
             {
                    return response()->json(['status'=>'success','message'=>'Data Fetched Successfully','data'=>$get_s_pizza]);
               
             }
             else
             {
                    return response()->json(['status'=>'failed','message'=>'No Data Found']);

             }

            }
            /// delete special pizza
            public function deleteSpecialPizza(Request $request)
            {
             if(isset($request['id']) && !empty($request['id']))
             {
               $id=$request->id;
             $find_id=DB::table('s_pizza')->where('id',$id)->exists();
             if($find_id=="true")
             {
              $find_s_pizza_id=DB::table('products')->where('id',$id)->first();
                $filename=$find_s_pizza_id->image;

                  if (!$filename == null) 
                  {
                        $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                        File::delete($file_path);
                  }
                  else
                  {

                  }
                  $delete_s_pizza=DB::table('s_pizza')->where('id',$id)->delete();
                  if($delete_s_pizza==1)
                  {
  
                    return response()->json(['status'=>'success','message'=>'Deleted successfully']);

                  }
                  else
                  {

                    return response()->json(['status'=>'failed','meesage'=>'Not Deleted ']);
                  }

             }
             else
             {

                    return response()->json(['status'=>'failed','meesage'=>'No Data Found']);

             }
            }
            else
            {
                    return response()->json(['status'=>'failed','meesage'=>'Incomplete Params']);

            }

            }

            public function BuildYourOwn(Request $request)
            {
               $rules =
                [
                    'cat_name' => "required",
                    'name' => "required",
                    'quantity'=>"required",
                    'cheese'=>"required",
                    'cheese_price'=>"required",
                    'sauce'=>"required",
                    'sauce_price'=>"required",
                    'topping'=>"required",
                    'topping_price'=>"required",
                ];
                if ($request->hasFile('image')) 
                {
                      $extension=$request['image']->extension();
                      $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
                      $check=in_array($extension,$allowedfileExtension);

                      if($check)
                      {
                        $extension = "." . $request->image->getClientOriginalExtension();
                        $name = basename($request->image->getClientOriginalName(), $extension) . time();
                        $name1 = $name . $extension;
                        $request->image->move('images/pizza-images/', $name1);
                      }
                      else
                      {

                      return response()->json(['status'=>'failed','message'=>'file should be image ']);
                      }
                    }
                    else
                    {
                      return response()->json(['status'=>'failed','message'=>'image is required']);

                    }
                        $validator = Validator::make($request->all(), $rules);

                        if ($validator->passes())     
                        {

                        $add_s_pizza=DB::table('ownpizza')->insertGetId(
                        [
                        'name'=>$request->name,
                        'image'=>'/pizza-images'.'/'.$name1,
                        'quntity'=>$request->quantity,
                        'price1'=>$request->price1,
                        'price2'=>$request->price2,
                        'size1'=>$request->size1,
                        'cheese'=>$request->cheese,
                        'cheese_price'=>$request->cheese_price,
                        'sauce'=>$request->sauce,
                        'sauce_price'=>$request->sauce_price,
                        'topping'=>$request->topping,
                        'topping_price'=>$request->topping_price,
                        'dough_price1'=>$request->dough_price1,
                        'dough_price2'=>$request->dough_price2
                        ]
                      );

                    if($add_s_pizza)
                    {
            
                    return response()->json(['status'=>'success','message'=>'inserted successfully']);

                    }
                    else
                    {
                
                    return response()->json(['status'=>'failed','message'=>'Not inserted try again']);

                    }

                } 
                else 
                {

                  $errors = $validator->errors();
                  return response()->json(['status'=>'failed','error'=>$errors]);
    
                }
            }
            public function getYourOwnPizza(Request $request)
            {
              $get_pizza=DB::table('ownpizza')->get();
              if(sizeof($get_pizza) > 0)
              {
                
                 return response()->json(['status'=>'success','message'=>'data fetched successfully','data'=>$get_pizza]);
              }
              else
              {
                 return response()->json(['status'=>'failed','message'=>'error occured']);

              }

            }
            public function delete_your_Pizza(Request $request)
            {
               if(isset($request['id']) && !empty($request['id']))
             {
              $id=$request->id;
              $get_id=DB::table('ownpizza')->where('id',$id)->exists();
              if($get_id=="true")
              {
              $delete_pizza=DB::table('ownpizza')->where('id',$id)->delete();

              if($get)
              {
               return response()->json(['status'=>'success','message'=>'deleted Successfully']);
              }
              else
              {
               return response()->json(['status'=>'failed','message'=>'Not deleted']);

              }
              }
              else
              {
               return response()->json(['status'=>'failed','message'=>'No data found']);

              }
            }
            else
            {
               return response()->json(['status'=>'failed','message'=>'Incomplete Params']);

            }
            }
            public function editYour_own_Pizza(Request $request)
            {
              if(isset($request['id']) && !empty($request['id']))
              {
             $id=$request->id;
             $find_pizza_id=DB::table('ownpizza')->where('id',$id)->first();
             $filename=$find_pizza_id->image;

             if($request->hasFile('image'))
             {
               if (!$filename == null) 
               {
                  $file_path = rtrim(app()->basePath('public/' . 'images/' . $filename));
                  File::delete($file_path);
                  $allowedfileExtension = ['gif', 'jpg', 'png', 'jpeg','gif','tiff','webp'];
    
                  $imageupload=$request->file('image');
                  $extension=$imageupload->extensnion();
                  $check=in_array($extension,$allowedfileExtension);
                  if($check)
                  {
                    $extension = "." . $request->image->getClientOriginalExtension();
                    $name = basename($request->image->getClientOriginalName(), $extension) . time();
                    $name1 = $name . $extension;
                    $request->image->move('images/pizza-images/', $name1);
                  }
                  else
                  {
                     return response()->json(['status'=>'failed','message'=>'file should be image']);
                  }
                  $edit=DB::table('ownpizza')->where('id',$id)->update(
                [
                    'name'=>$request->name,
                    'image'=>'/pizza-images'.'/'.$name1,
                    'quntity'=>$request->quantity,
                    'price1'=>$request->price1,
                    'price2'=>$request->price2,
                    'size1'=>$request->size1,
                    'cheese'=>$request->cheese,
                    'cheese_price'=>$request->cheese_price,
                    'sauce'=>$request->sauce,
                    'sauce_price'=>$request->sauce_price,
                    'topping'=>$request->topping,
                    'topping_price'=>$request->topping_price,
                    'dough_price1'=>$request->dough_price1,
                    'dough_price2'=>$request->dough_price2 
                ]
                );
             if($edit)
             {

              return response()->json(['status'=>'success','message'=>'successfully Updated']);

             } 
             else
             {

              return response()->json(['status'=>'failed','message'=>'error Ocurred']);
      
             }
              
             }
             }
             else
             {
      
              $edit=DB::table('ownpizza')->where('id',$id)->update(
                [
                    'name'=>$request->name,
                    'quntity'=>$request->quantity,
                    'price1'=>$request->price1,
                    'price2'=>$request->price2,
                    'size1'=>$request->size1,
                    'cheese'=>$request->cheese,
                    'cheese_price'=>$request->cheese_price,
                    'sauce'=>$request->sauce,
                    'sauce_price'=>$request->sauce_price,
                    'topping'=>$request->topping,
                    'topping_price'=>$request->topping_price,
                    'dough_price1'=>$request->dough_price1,
                    'dough_price2'=>$request->dough_price2 
                ]
                );
                if($edit)
                  {

                    return response()->json(['status'=>'success','message'=>'successfully Updated']);
                  } 
                  else
                  {
                    return response()->json(['status'=>'failed','message'=>'error Ocurred']);
            
                  }             

             } 
            }
            else
            {
                    return response()->json(['status'=>'failed','message'=>'Incomplete Params']);

            }         
            } 