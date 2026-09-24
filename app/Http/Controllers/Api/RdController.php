<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RdMaster;

class RdController extends Controller
{
    public function index()
    {
        $rds = RdMaster::with('details')->where('status', 1)->latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'RD Plans fetched successfully',
            'data' => $rds
        ], 200);
    }
}
