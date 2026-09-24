<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SelectionProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SelectionProductController extends Controller
{
    public function index()
    {
        $products = SelectionProduct::all();
        return view('admin.selection_products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new SelectionProduct();
        $product->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/selection_products'), $image_name);
            $product->image = 'uploads/selection_products/' . $image_name;
        }

        $product->save();

        return back()->with('success', 'Success|Product added successfully!');
    }

    public function destroy($id)
    {
        $product = SelectionProduct::findOrFail($id);
        if (File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }
        $product->delete();

        return back()->with('success', 'Success|Product deleted successfully!');
    }

    public function report(Request $request)
    {
        $products = SelectionProduct::all();
        $query = User::whereNotNull('selection_product_id')->with('selectionProduct');

        if ($request->product_id) {
            $query->where('selection_product_id', $request->product_id);
        }

        $users = $query->paginate(20);

        return view('admin.selection_products.report', compact('users', 'products'));
    }
}
