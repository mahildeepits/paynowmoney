<?php

namespace App\Http\Controllers\Member;

use DB;
use App\Models\Epin;
use App\Models\User;
use App\Models\UserSeries;
use App\Models\AdminCharge;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\RewardHelper;

class StudentRegistrationController extends Controller
{
    public function index(){
        return view('registration.index');
    }

    public function register(Request $request)
    {
        try{
            DB::beginTransaction();
            $adminSettings = AdminCharge::first();
            $userSeries = UserSeries::first();
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'course_id' => 'required|exists:courses,id',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'country' => 'required|numeric',
                'district' => 'required|string|max:255',
                'aadhaar_no' => 'required|string|max:255|unique:student_details',
                'language' => 'required|string|max:50',
                'qualification' => 'required|string|max:255',
                'class_type' => 'required|string|max:50',
                'class_center' => 'nullable|string|max:100',
                'sponsor_id' => 'required',
                'pin_no' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if(!$this->verifyEpin($request->pin_no)){
                return redirect()->back()->withErrors(['pin_no'=>'Epin not found'])->withInput();
            }

            $isSuponsorExists = User::where('member_id',$request->sponsor_id)->first();
            if($isSuponsorExists == null){
                return redirect()->back()->withErrors(['sponsor_id'=>'Sponsor not found'])->withInput();
            }
            $sponsor_id = $request->sponsor_id;
            $parent_id = null;
            if($isSuponsorExists->role == 7){
                $sponsor_id = $isSuponsorExists->sponsor_id;
                $parent_id = $request->sponsor_id;
            }

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'parent_leg' => 0,
                'member_id' => $adminSettings->id_prefix . str_pad($userSeries->series, 5, 0, STR_PAD_LEFT),
                'password' => Hash::make($request->password),
                'sponsor_id' => $sponsor_id,
                'parent_id' => $parent_id,
                'role' => 7,
                'mobile' => $request->phone,
                'epin' => $request->pin_no,
                'is_paid' => 1,
                'user_icon' => 'userpaid.png',
                'father_name' => $request->father_name,
            ]);
            $this->verifyEpin($request->pin_no,$user->id);
            // Create the student details
            StudentDetail::create([
                'user_id' => $user->id,
                'course_id' => $request->course_id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'country' => $request->country,
                'district' => $request->district,
                'aadhaar_no' => $request->aadhaar_no,
                'language' => $request->language,
                'qualification' => $request->qualification,
                'class_type' => $request->class_type,
                'class_center' => $request->class_center,
            ]);
            $this->updateUserSeries();
            RewardHelper::studentRegIncentive($user->id);
            DB::commit();
            // Redirect to a success page
            return redirect()->route('login')->with('success', 'Success|Registration successful. Please login.');
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    protected function verifyEpin($epin,$user_id = null)
    {
        $pinExists = Epin::where('pin_no', $epin)
            ->whereNull('used_by')
            ->first();

        if ($pinExists != null && $user_id != null) {
            $pinExists->update(['used_by' => $user_id,'used_at' => now()]);
        }

        return $pinExists !== null;
    }

    public function updateUserSeries()
    {
        $userSeries = UserSeries::first();
        $userSeries->update(['series' => $userSeries->series + 1]);
    }
}
