<?php

namespace App\Http\Controllers\Api;

use App\Helpers\RewardHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Mail\RegisterEmail;
use App\Models\AdminCharge;
use App\Models\Epin;
use App\Models\PairCarry;
use App\Models\Payout;
use App\Models\Position;
use App\Models\UnpaidPayout;
use App\Models\User;
use App\Models\Role;
use App\Models\UserSeries;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\KycDoc;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(ApiLoginRequest $request)
    {
        $user = User::where('member_id', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Wrong username or password',
                'data' => null
            ], 401);
        }

        if ($user->is_blocked == 1) {
            return response()->json([
                'status' => false,
                'message' => 'User is blocked',
                'data' => null
            ], 403);
        }

        if ($user->role == 1) {
            return response()->json([
                'status' => false,
                'message' => 'This user is not allowed to login here',
                'data' => null
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $rewards = $user->latestReward();
        $rank = $rewards !== null ? $rewards->reward->rank : 'No Rank';

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'rank' => $rank,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }

    public function register(ApiRegisterRequest $request)
    {
        DB::beginTransaction();
        $adminSettings = AdminCharge::first();
        $epin = null;
        try {
            if ($request->has('epin') && !empty($request->epin)) {
                $epin = Epin::where(['pin_no' => $request->epin, 'used_by' => null])->first();
                if ($request->epin != '1231231') {
                    if ($epin == null) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Incorrect Epin',
                            'data' => null
                        ], 400);
                    }
                }
            }

            // Check if sponsor is paid
            if ($request->has('sponsor')) {
                $sponsorUser = User::where('member_id', $request->sponsor)->first();
                if (!$sponsorUser) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sponsor not found',
                        'data' => null
                    ], 400);
                }
                if ($sponsorUser->is_paid == 0) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sponsor is not active and cannot sponsor new members.',
                        'data' => null
                    ], 400);
                }
            }

            $memberIds = User::whereNotNull('member_id')->get()->pluck('member_id')->toArray();
            do {
                $member_id = (string) mt_rand(1000000000, 9999999999);
            } while (in_array($member_id, $memberIds));
            
            $userModel = new User;
            $userModel->name = $request->full_name;
            $userModel->email = $request->email;
            $userModel->mobile = $request->mobile;
            $userModel->sponsor_id = $request->sponsor;
            $userModel->parent_id = $request->sponsor;
            $userModel->member_id = $member_id;
            $userModel->password = Hash::make($request->password);
            $userModel->enc_password = Crypt::encrypt($request->password);
            $userModel->role = 3;
            $userModel->parent_leg = 'left';
            
            if ($epin != null) {
                $userModel->is_paid = 1;
                $userModel->user_icon = 'userpaid.png';
            } else {
                $userModel->is_paid = 0;
                $userModel->user_icon = 'userunpaid.png';
            }
            $userModel->save();

            // Handle Profile Data
            if ($request->hasAny(['address', 'city', 'state', 'pin_code', 'nominee_name'])) {
                $userProfile = new UserProfile();
                $userProfile->user_id = $userModel->id;
                $userProfile->address = $request->address;
                $userProfile->city = $request->city;
                $userProfile->state = $request->state;
                $userProfile->pin_code = $request->pin_code;
                $userProfile->nominee_name = $request->nominee_name;
                $userProfile->save();
            }

            // Handle KYC Docs
            if ($request->hasFile('card_front') || $request->hasFile('card_back')) {
                $kycDocs = new KycDoc();
                $kycDocs->user_id = $userModel->id;
                $kycDocs->kyc_type = 'Aadhaar Card'; // Default or based on request
                
                if ($request->hasFile('card_front')) {
                    $CardFront = "IMG_" . time() . '_' . rand(11111111, 9999999) . '.' . $request->file('card_front')->getClientOriginalExtension();
                    $request->file('card_front')->move(public_path('images/kyc_docs/'), $CardFront);
                    $kycDocs->card_front = $CardFront;
                }
                
                if ($request->hasFile('card_back')) {
                    $CardBack = "IMG_" . time() . '_' . rand(11111111, 9999999) . '.' . $request->file('card_back')->getClientOriginalExtension();
                    $request->file('card_back')->move(public_path('images/kyc_docs/'), $CardBack);
                    $kycDocs->card_back = $CardBack;
                }
                $kycDocs->save();
            }

            // Create 16 EMIs
            $startDate = Carbon::now();
            for ($i = 0; $i < 16; $i++) {
                \App\Models\Emi::create([
                    'user_id' => $userModel->id,
                    'amount' => 1300,
                    'month' => $startDate->copy()->addMonths($i)->format('F Y'),
                    'status' => 'submitted',
                    'paid_at' => now(),
                ]);
            }

            if ($request->has('epin') && !empty($request->epin) && $request->epin != '1231231') {
                $this->updateUsedPin($request, $userModel);
            }
            $this->updateParentString($userModel);

            // We are deliberately ignoring savePinData as it's undefined in original AuthController as well.
            // But if it is needed, it would crash in original. We replicate original behavior.

            // $this->sendEmail($request->email, $userModel);
            
            DB::commit();

            $token = $userModel->createToken('auth_token')->plainTextToken;

            $registerDetails = $request->all();
            $registerDetails['user_id'] = $userModel->member_id;
            $registerDetails['sponsor'] = $request->sponsor;
            $registerDetails['sponsor_name'] = $request->sponsor_name;

            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'data' => [
                    'register_details' => $registerDetails,
                    'user' => $userModel,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Registration failed: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    private function sendEmail($email, $userModel, $coupon_code = null)
    {
        Mail::to($email)->send(new RegisterEmail($userModel, $coupon_code));
    }

    protected function updateUsedPin($request, $user)
    {
        Epin::where(['pin_no' => $request->epin])->update([
            'used_by' => $user->id,
            'used_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function updateParentString($registeredUser)
    {
        $parentUser = User::where(['member_id' => $registeredUser->parent_id])->first();
        if ($parentUser != null && $parentUser->parent_string != null) {
            $registeredUser->parent_string = $parentUser->parent_string . ',' . $registeredUser->id;
            $registeredUser->save();
        } else {
            $registeredUser->parent_string = $registeredUser->id;
            $registeredUser->save();
        }
    }

    public function checkSponsor(Request $request)
    {
        $request->validate([
            'sponsor_id' => 'required|string'
        ]);

        $sponsor = User::where('member_id', $request->sponsor_id)->first();
        
        if (!$sponsor) {
            return response()->json([
                'status' => false,
                'message' => 'Sponsor not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sponsor found',
            'data' => [
                'name' => $sponsor->name
            ]
        ], 200);
    }
}
