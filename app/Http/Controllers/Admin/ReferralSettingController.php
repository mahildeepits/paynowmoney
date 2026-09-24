<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReferralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = ReferralSetting::orderBy('type')->orderBy('level')->get();
        return view('admin.referral-settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = ReferralSetting::TYPES;
        return view('admin.referral-settings.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(ReferralSetting::TYPES)],
            'level' => ['required', 'array'],
            'level.*' => ['required', 'integer', 'min:1'],
            'percentage' => ['required', 'array'],
            'percentage.*' => ['required', 'numeric', 'min:0'],
        ]);

        $type = $request->type;
        $levels = $request->level;
        $percentages = $request->percentage;

        // Check for duplicates in the submitted array
        if (count($levels) !== count(array_unique($levels))) {
            return back()->withInput()->with('error', 'Error|Duplicate levels found in your input.');
        }

        // Check for duplicates in the database
        $existingLevels = ReferralSetting::where('type', $type)->whereIn('level', $levels)->pluck('level')->toArray();
        if (count($existingLevels) > 0) {
            $duplicateList = implode(', ', $existingLevels);
            return back()->withInput()->with('error', "Error|The following levels already exist for type {$type}: {$duplicateList}");
        }

        try {
            foreach ($levels as $index => $level) {
                ReferralSetting::create([
                    'type' => $type,
                    'level' => $level,
                    'percentage' => $percentages[$index],
                ]);
            }
            return redirect()->route('admin.referral-settings.index')->with('success', 'Success|Referral settings saved successfully.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Error|' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $setting = ReferralSetting::findOrFail($id);
            $setting->delete();
            return redirect()->route('admin.referral-settings.index')->with('success', 'Success|Referral setting deleted successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error|' . $th->getMessage());
        }
    }
}
