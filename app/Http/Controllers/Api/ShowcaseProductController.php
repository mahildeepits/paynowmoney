<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShowcaseProduct;
use Illuminate\Http\Request;

class ShowcaseProductController extends Controller
{
    public function index()
    {
        $products = ShowcaseProduct::where('status', true)->latest()->get();
        
        $data = $products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'mrp' => $product->mrp,
                'description' => $product->description,
                'image_url' => $product->image_url,
                'created_at' => $product->created_at,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Showcase products retrieved successfully.',
            'data' => $data
        ]);
    }
}
