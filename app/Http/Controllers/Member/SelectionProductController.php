<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\SelectionProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectionProductController extends Controller
{
    public function index()
    {
        $user = Auth::guard('member')->user();
        $selectedProduct = $user->selectionProduct;
        $products = SelectionProduct::all();

        return view('member.selection_products.index', compact('user', 'selectedProduct', 'products'));
    }

    public function select(Request $request)
    {
        $user = Auth::guard('member')->user();

        if ($user->selection_product_id) {
            return back()->with('error', 'Error|You have already selected a product!');
        }

        $request->validate([
            'product_id' => 'required|exists:selection_products,id',
        ]);

        $user->selection_product_id = $request->product_id;
        $user->save();

        return back()->with('success', 'Success|Product selected successfully!');
    }
}
