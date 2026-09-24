<?php

namespace App\Http\Controllers\Api;

use App\Models\KycDoc;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\UserBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ApiUpdateProfileRequest;
use App\Http\Requests\ApiUpdateKycRequest;
use App\Http\Requests\ApiUpdateBankRequest;
use App\Http\Requests\ApiChangePasswordRequest;

class AccountController extends Controller
{
    /**
     * Get unified account overview (Profile, KYC, Bank)
     */
    public function accountOverview(Request $request)
    {
        $user = auth()->user();
        
        $profile = UserProfile::where('user_id', $user->id)->first();
        $kyc = KycDoc::where('user_id', $user->id)->get();
        $bank = UserBankDetail::where('user_id', $user->id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Account overview fetched successfully',
            'data' => [
                'user' => $user,
                'profile' => $profile,
                'kyc' => $kyc,
                'bank_details' => $bank
            ]
        ], 200);
    }

    /**
     * Update Profile
     */
    public function updateProfile(ApiUpdateProfileRequest $request)
    {
        $user = auth()->user();
        
        $userProfile = UserProfile::firstOrNew(['user_id' => $user->id]);
        $userProfile->father_name = $request->father_name;
        $userProfile->dob = $request->dob;
        $userProfile->gender = $request->gender;
        $userProfile->address = $request->address;
        $userProfile->pin_code = $request->pin_code;
        $userProfile->city = $request->city;
        $userProfile->state = $request->state;
        $userProfile->country = $request->country;
        $userProfile->nominee_name = $request->nominee_name;
        $userProfile->nominee_relation = $request->nominee_relation;
        $userProfile->save();

        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('father_name')) $user->father_name = $request->father_name;
        if ($request->has('gender')) $user->gender = $request->gender;
        if ($request->has('dob')) $user->dob = $request->dob;
        if ($request->has('mobile')) $user->mobile = $request->mobile;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully!',
            'data' => [
                'user' => $user,
                'profile' => $userProfile
            ]
        ], 200);
    }

    /**
     * Update Profile Image
     */
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image'
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $fileName = 'IMG_PROFILE_' . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'profile_images/';
    
            if ($user->profile_image && Storage::exists($destinationPath . $user->profile_image)) {
                Storage::delete($destinationPath . $user->profile_image);
            }
    
            $path = $image->storeAs($destinationPath, $fileName, 'public');
            $user->profile_image = $fileName;
            $user->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile image updated successfully!',
            'data' => [
                'profile_image_url' => $user->profile_image_url
            ]
        ], 200);
    }

    /**
     * Update KYC Documents
     */
    public function updateKycDocuments(ApiUpdateKycRequest $request)
    {
        $user = auth()->user();
        $kycDocs = KycDoc::where('user_id', $user->id)->where('kyc_type', $request->kyc_type)->first();
        
        if ($kycDocs == null) {
            $kycDocs = new KycDoc();
            $kycDocs->user_id = $user->id;
            $kycDocs->fill($request->except(['card_front', 'card_back']));
            
            if ($request->hasFile('card_front') && $request->hasFile('card_back')) {
                $CardFront = "IMG_" . time() . '_' . rand(11111111, 9999999) . '.' . $request->file('card_front')->getClientOriginalExtension();
                $request->file('card_front')->move(public_path('images/kyc_docs/'), $CardFront);
                
                $CardBack = "IMG_" . time() . '_' . rand(11111111, 9999999) . '.' . $request->file('card_back')->getClientOriginalExtension();
                $request->file('card_back')->move(public_path('images/kyc_docs/'), $CardBack);
                
                $kycDocs->card_front = $CardFront;
                $kycDocs->card_back = $CardBack;
            }
            $kycDocs->save();

            return response()->json([
                'status' => true,
                'message' => 'KYC details saved successfully!',
                'data' => $kycDocs
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "You can't update the details again!",
                'data' => null
            ], 403);
        }
    }

    /**
     * Save Bank Details
     */
    public function saveBankDetails(ApiUpdateBankRequest $request)
    {
        $user = auth()->user();
        $userBankDetailModel = UserBankDetail::firstOrNew(['user_id' => $user->id]);
        
        if ($userBankDetailModel->exists) {
            return response()->json([
                'status' => false,
                'message' => "You can't edit bank details once updated!",
                'data' => null
            ], 403);
        }
        
        $userBankDetailModel->fill($request->all());
        $userBankDetailModel->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Bank details updated successfully!',
            'data' => $userBankDetailModel
        ], 200);
    }

    /**
     * Update Password
     */
    public function updatePassword(ApiChangePasswordRequest $request)
    {
        if ($request->new_password != $request->conf_password) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => [
                    'conf_password' => ['Password do not match!']
                ]
            ], 422);
        }

        $user = auth()->user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'data' => [
                    'current_password' => ['Incorrect current password!']
                ]
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully!',
            'data' => null
        ], 200);
    }
}
