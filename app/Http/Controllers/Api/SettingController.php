<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReferralSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getReferralSettings()
    {
        $settings = ReferralSetting::orderBy('type')->orderBy('level')->get();
        
        $data = [];
        foreach (ReferralSetting::TYPES as $type) {
            $data[$type] = $settings->where('type', $type)->map(function ($item) {
                return [
                    'level' => (int) $item->level,
                    'percentage' => (float) $item->percentage
                ];
            })->values()->toArray();
        }

        return response()->json([
            'status' => true,
            'message' => 'Referral settings fetched successfully',
            'data' => $data
        ]);
    }

    public function getAppSettings()
    {
        $settings = Setting::pluck('value', 'key');
        return response()->json([
            'status' => true,
            'message' => 'App settings fetched successfully',
            'data' => $settings
        ]);
    }
}
