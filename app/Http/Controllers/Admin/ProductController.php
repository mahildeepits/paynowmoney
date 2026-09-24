<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Str;

class ProductController extends Controller
{
    public function index(){
        return view('admin.products.add_product');
    }
    public function store(Request $request){
        
       $data=$request->except('images');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'description' => 'required',
            'Dilevery_Charges' => 'required',
            'stock_available' => 'required|integer',
            'quantity' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value > $request->input('stock_available')) {
                        $fail('The '.$attribute.' cannot exceed the stock available.');
                    }
                },
            ],
            'Available_Sizes' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }   
        
        $image=$request->file('images');
        $data=new Product();
        $data->name=$request->name;
        $data->category_id=$request->category_list;
        $data->sub_category_id=$request->sub_category_list;
        $data->price=$request->price;
        $data->discount=$request->discount;
        $data->description=$request->description;
        $data->stock_available=$request->stock_available;
        $data->quantity=$request->quantity;
        $data->delivery_charge=$request->Dilevery_Charges;
        $data->sizes=$request->Available_Sizes;
        $data->save();
        
         foreach ($image as $key => $value) {
            $extension = $value->getClientOriginalExtension();
            $pathname = $value->getPathname();
            if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
                $image_name = rand() . '.' . $extension;
                $fullPath = "assets/product/images/";
                $value->move(public_path('/product/images/'), $image_name);
                $imagedata = new Image();
                $imagedata->product_id = $data->id;
                $imagedata->image_path = $image_name;
                $inserted = $imagedata->save();
            }
         }

        if($data==true){
            return response()->json(['type' => 'success', 'msg' => 'Success|Product Saved Successfully!']);
        }
        else{
            return response()->json(['type' => 'error','msg' => 'Error|Product not  Saved Successfully!']);
        }
        
    }
    public function get_subcategory($id){
        $data=Category::where('parent',$id)->get();
        
        if ($data->isEmpty()) {
            return response()->json(['type' => 'error', 'data' => $data]);
        } else {
            return response()->json(['type' => 'success', 'data' => $data]);
        }
       

    }
    public function list(){
       $product=Product::with('album')->get();
       return view('admin.products.view_product',['products'=>$product]);
    }
    public function destroy($id){
         $image=Image::where('product_id',$id)->delete();
            $product=Product::where('id',$id)->delete();
            if($product==true){
                session()->flash('success','Success|Product deleted Successfully!');
                return back();
            }
       
        //  dd($product->album()->detach($id));
        
    }
    public function edit($id){
            $category=Category::get();
            $product=Product::with('album','subcategory')->where('id',$id)->first();
            $get_images=Image::where('product_id',$product->id)->get();
            return view('admin.products.edit_product', ['product' => $product,'get_images'=>$get_images,'category'=>$category]);


    }
    public function destroyimage($id){
            if(!empty($id)){
                $image=Image::where('id',$id)->first();
                $image_path = $image->image_path;
                if(\File::exists(public_path("/product/images/".$image_path))){
                    \File::delete(public_path("/product/images/$image_path"));
                    $delete = $image->delete();
                    if($delete==true){
                        return response()->json(['type' => 'success', 'msg' => 'Album Image is deleted.']);
                    }
                    else{
                        return response()->json(['type' => 'error', 'msg' => 'Album Image is not deleted.']);
                    }
                }
            }
    }
    public function update(Request $request){
           
            $validator = Validator::make($request->all(),[

                'name' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'description' =>'required',
                'Dilevery_Charges' =>'required',
                'Available_Sizes' =>'required',
                'quantity'=>'required',
            ]);
    
            if($validator->fails())
            {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $image=$request->file('images');
            $data=Product::where('id',$request->edit_id)->first();
            $data->name=$request->name;
            $data->category_id=$request->category_list;
            $data->sub_category_id=$request->sub_category_list;
            $data->price=$request->price;
            $data->discount=$request->discount;
            $data->description=$request->description;
            // $data->stock_available=$request->stock_available;
            $data->quantity=$request->quantity;
            $data->delivery_charge=$request->Dilevery_Charges;
            $data->sizes=$request->Available_Sizes;
            $data->update();
            foreach ($image as $key => $value) {
                $extension = $value->getClientOriginalExtension();
                $pathname = $value->getPathname();
                if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
                    $image_name = rand() . '.' . $extension;
                    $fullPath = "assets/product/images/";
                    $value->move(public_path('/product/images/'), $image_name);
                    $imagedata = new Image();
                    $imagedata->product_id = $request->edit_id;
                    $imagedata->image_path = $image_name;
                    $inserted = $imagedata->save();
                }
             }
    }
    public function Deleted_product_list(){
            $deleted_list=Product::WhereNotNull('deleted_at')->onlyTrashed()->get();
            return view('admin.products.deleted_product',['deleted_lists'=>$deleted_list]);
    }
}
