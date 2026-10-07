<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShowcaseProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowcaseProductController extends Controller
{
    public function index()
    {
        $products = ShowcaseProduct::latest()->get();
        return view('admin.showcase_products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.showcase_products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('showcase_products', 'public');
        }

        ShowcaseProduct::create($data);

        return redirect()->route('admin.showcase-products.index')->with('success', 'Showcase Product created successfully.');
    }

    public function edit($id)
    {
        $product = ShowcaseProduct::findOrFail($id);
        return view('admin.showcase_products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = ShowcaseProduct::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('showcase_products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.showcase-products.index')->with('success', 'Showcase Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = ShowcaseProduct::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.showcase-products.index')->with('success', 'Showcase Product deleted successfully.');
    }
}
