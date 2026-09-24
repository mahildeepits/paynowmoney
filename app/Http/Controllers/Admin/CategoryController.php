<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    public function createCategory(Request $request,$id='')
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        $categoris_table = Category::with('subcategory')->get();
        if($request->method()=='GET')
        {
            return view('admin.categories.add_category', compact('categories','categoris_table'));
        }
        if($request->method()=='POST')
        {
            // dd($request);
            $validator = $request->validate([
                'name'      => 'required',
                'parent_id' => 'nullable|numeric',
                'status' => 'required',
                'image'=> 'mimes:jpeg,jpg,png,gif|max:2000|required',
        ]);

        $remove_space_from_slug = str_replace(" ", "-", $request->category_slug);
        $convert_capital_word_into_small=strtolower($remove_space_from_slug);
        $remove_all_special_chracter=preg_replace('/[^A-Za-z0-9\-]/', '',$convert_capital_word_into_small);
        $response=Category::where(['category_slug'=>$remove_all_special_chracter])->first()->category_slug??False;
        if($response==true){
            session()->flash('slug_exit','This Slug is already used');
            return redirect()->back()->withInput();;
        }

        $store=new Category();
        if($request->hasFile("image")){
            $rand=rand(111111111111,999999999999);
            $category_img=$request->file("image");
            $ext=$category_img->extension();
            $category_name=$rand.'.'.$ext;
            $store->category_images=$category_name;
            $category_img->move(public_path('category/images/'), $category_name);
         }
             $store->name=$request->name;
             $store->category_slug=$request->slug;
             $store->parent_id=$request->parent_id;
             $store->category_slug=$remove_all_special_chracter;
             $store->category_type=$request->category_Type;
             $store->is_home=1;
             $store->status=$request->status;
             $store->save();
            if($store==true){
                session()->flash('success_msg','Category has been created successfully!');
            }
            return redirect()->back();
        }
    }

    public function delete($id){

      $exit=Category::where('parent_id',$id)->first()??'';
      if($exit){
        session()->flash('exit','This parent have another child!!');
        return redirect()->back();
      }

       $delete=Category::find($id);
            $file_name=$delete->category_images??'';
            if($delete==true){
               $delete_done=$delete->delete();
                    if($delete_done==true){
                        if (File::exists(public_path('category/images/'.$file_name))) {
                            File::delete(public_path('category/images/'.$file_name));
                        }
                    }
                session()->flash('success_msg','Category has been deleted successfully!');
                return redirect()->back();
            }else{
                return redirect()->back();
            }
    }

    public function edit(Request $request, $id=''){
        $update=Category::find($request->update_id);
        $file_name=$update->category_images??'';
        if($request->method()=='GET')
        {
            $edit=Category::find($id);
            $categoris_table = Category::get();
            $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
            return view('admin.categories.edit_category',compact('edit','categories','categoris_table'));
        }

        if($request->method()=='POST'){
            $validator = $request->validate([
                'name'      => 'required',
                'parent_id' => 'nullable|numeric',
                'status' => 'required',
                'image'=> 'mimes:jpeg,jpg,png,gif|max:2000',
            ]);
            $remove_space_from_slug = str_replace(" ", "-", $request->category_slug);
            $convert_capital_word_into_small=strtolower($remove_space_from_slug);
            $remove_all_special_chracter=preg_replace('/[^A-Za-z0-9\-]/', '',$convert_capital_word_into_small);

            $response=Category::where(['category_slug'=>$remove_all_special_chracter])->where('id','!=',$request->update_id)->first()->category_slug??False;
            if($response==true){
                session()->flash('slug_exit','This Slug is already used');
                return redirect()->back();
            }

            if($request->hasFile("image")){
                if($file_name==true){
                    if (File::exists(public_path('category/images/'.$file_name))) {
                        File::delete(public_path('category/images/'.$file_name));
                    }
                }
                $rand=rand(111111111111,999999999999);
                $category_img=$request->file("image");
                $ext=$category_img->extension();
                $category_name=$rand.'.'.$ext;
                $update->category_images=$category_name;
                $category_img->move(public_path('category/images/'), $category_name);
             }

              $update->name=$request->name;
              $update->category_slug=$remove_all_special_chracter;
              $update->category_type=$request->category_Type;
              $update->status=$request->status;
              $update->save();

           if($update==true){
               session()->flash('success_msg','Category has been updated successfully!');
           }
           return redirect()->back();
        }
    }
}
