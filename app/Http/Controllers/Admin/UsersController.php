<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCharge;
use App\Models\KycDoc;
use App\Models\User;
use App\Models\UserBankDetail;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request){
        $kycDetails = null;
        if($request->has('block_user')){
            User::whereId($request->block_user)->update(['is_blocked'=>1,'user_icon'=>'blocked.png']);
            return redirect()->back();
        }
        if($request->has('unblock_user')){
            User::whereId($request->unblock_user)->update(['is_blocked'=>0,'user_icon'=>'userpaid.png']);
            return redirect()->back();
        }
        if($request->has('kyc_details')){
            $kycDetails = KycDoc::whereUserId($request->kyc_details)->first();
        }
        $usersModel = User::whereIn('role',[3])->get();
        return view('admin.users.index',['users'=>$usersModel,'kycDetails'=>$kycDetails]);
    }

    public function editUser(Request $request){
        $userModel = [];
        if($request->has('member_id')){
            $userModel = User::with(['profile_rel','bank_details'])->whereMemberId($request->member_id)->first();
            if($userModel != null && $userModel->profile_rel != null){
                $userProfile = $userModel->profile_rel->toArray();
                unset($userModel['id']);
                $userModel = array_merge($userModel->toArray(),$userProfile);
            }
            if($userModel != null && $userModel['bank_details'] != null){
                $userModel = (!is_array($userModel))?$userModel->toArray():$userModel;
                $bankDetails = $userModel['bank_details'];
                unset($bankDetails['id']);
                $userModel = array_merge($userModel,$bankDetails);
                $userModel['bank_nominee_name'] = $userModel['nominee_name'];
                $userModel['bank_nominee_relation'] = $userModel['nominee_relation'];
                $userModel['bank_nominee_dob'] = $userModel['nominee_dob'];
            }
        }
        return view('admin.users.profile',compact('userModel'));
    }

    public function profileUpdate(Request $request){
        $userModel = User::find($request->id);
        $userModel->fill($request->except(['password']));
        if($request->has('password') && $request->password != null){
            $userModel->password = \Hash::make($request->password);
            $userModel->enc_password = \Crypt::encrypt($request->password);
        }
        $userModel->save();
        $userProfileModel = UserProfile::whereUserId($userModel->id)->firstOrNew();
        $userProfileModel->fill($request->all());
        $userProfileModel->user_id = $userModel->id;
        $userProfileModel->save();

        //User Bank Details
        $userBankDetailsModel = UserBankDetail::whereUserId($userModel->id)->firstOrNew();
        $userBankDetailsModel->nominee_name = $request->bank_nominee_name;
        $userBankDetailsModel->nominee_relation = $request->bank_nominee_relation;
        $userBankDetailsModel->nominee_dob = $request->bank_nominee_dob;
        $userBankDetailsModel->bank_name = $request->bank_name;
        $userBankDetailsModel->bank_address = $request->bank_address;
        $userBankDetailsModel->pan_number = $request->pan_number;
        $userBankDetailsModel->account_number = $request->account_number;
        $userBankDetailsModel->ifsc_code = $request->ifsc_code;
        $userBankDetailsModel->user_id = $userModel->id;
        $userBankDetailsModel->save();
        \Session::flash('success','Success|User profile updated successfully!');
        return back();
    }

    public function editKyc(Request $request){
        $kycDetails = [];
        $userDetails = [];
        if($request->has('member_id')){
            if($request->member_id == ''){
                return redirect()->back();
            }
        }
        if(($request->has('member_id') && $request->member_id != '') || $request->has('user_id')){
            if($request->has('member_id')){
                $userDetails = User::whereMemberId($request->member_id)->first();
            }
            if($request->has('user_id')){
                $userDetails = User::find($request->user_id);
            }
            $name = $userDetails->name;
            $kycDetails = KycDoc::whereUserId($userDetails->id)->first();
            if($kycDetails != null){
                $kycDetails = $kycDetails->toArray();
            }else{
                $kycDetails = [];
            }
            $kycDetails['name'] = $name;
        }
        return view('admin.users.kyc-details',['kycDetails' => $kycDetails,'user'=>$userDetails]);
    }

    public function updateKycDetails(Request $request){
        $rules = [
            'kyc_type' => 'required',
            'card_no' => 'required',
            'name' => 'required'
        ];
        $request->validate($rules);
        $kycDocs = KycDoc::whereUserId($request->id)->firstOrNew();
        $kycDocs->user_id = $request->id;
        $kycDocs->fill($request->except(['card_front','card_back']));
        $cards = $this->uploadImages($request);
        if($cards['card_front'] != ''){
            $kycDocs->card_front = $cards['card_front'];
        }
        if($cards['card_back'] != ''){
            $kycDocs->card_back = $cards['card_back'];
        }
        $kycDocs->save();
        \Session::flash('success','Success|KYC details saved successfully!');
        return back();
    }

    private function uploadImages(Request $request){
        $CardFront = '';
        $CardBack = '';
        if($request->hasFile('card_front')){
            $CardFront = "IMG_".time().'_'.rand(11111111,9999999).'.'.$request->file('card_front')->getClientOriginalExtension();
            $request->file('card_front')->move('images/kyc_docs/',$CardFront);
        }
        if($request->hasFile('card_back')){
            $CardBack = "IMG_".time().'_'.rand(11111111,9999999).'.'.$request->file('card_back')->getClientOriginalExtension();
            $request->file('card_back')->move('images/kyc_docs/',$CardBack);
        }
        return ['card_front'=>$CardFront,'card_back'=>$CardBack];
    }

    public function adminCharges(Request $request){

        $details = AdminCharge::first();
        if($request->isMethod('post')){
            $validator = $request->validate([
                'tds_charges' => 'required|numeric',
                'admin_charges' => 'required|numeric',
                'direct_amount' => 'required|numeric',
                'pair_amount' => 'required|numeric',
                'capping_of_pair' => 'required|numeric',
                'activation_fee' => 'required|numeric'
            ]);

            $adminCharges = AdminCharge::firstOrNew();
            $adminCharges->fill($request->all());
            $adminCharges->save();
            \Session::flash('success','Success|Charges saved successfully!');
            return back();
        }
        return view('admin.admin-charges.index',compact('details'));
    }

    public function setUserToPaid($userId){
        $user = User::find($userId);
        if($user != null){
            $user->user_icon = 'payment-done.png';
            $user->is_paid = 1;
            $user->save();
            Session::flash('success','Success|User set to paid successfully!');
        }
        return back();
    }

    public function searchMembers(Request $request){
        return User::where('member_id','like','%'.$request->term.'%')
            ->select(['member_id','id'])->get();
    }

    public function makeFranchiseUser($user_id, $type) {
        $userModel = User::find($user_id);
        $userModel->is_franchise = $type == 'make' ? 1 : 0;

        $user = $userModel->save();
        if($user) {
            if ($userModel->is_franchise == 1) {
                \Session::flash('success', "Success|User is now a franchise user successfully!");
            } else{
                \Session::flash('error', "Error|User is successfully removed from franchise user!");
            }
        }
        else{
            \Session::flash('error', "Error|Something went wrong!");
        }

        return back();
    }

    public function getUserKyc($id)
    {
        $kyc = \App\Models\UserKyc::where('user_id', $id)->first();
        $user = \App\Models\User::find($id);

        if (!$kyc) {
            return response()->json(['status' => false, 'message' => 'No KYC found for this user', 'user_name' => $user->name, 'member_id' => $user->member_id]);
        }

        return response()->json([
            'status' => true,
            'data' => $kyc,
            'user_name' => $user->name,
            'member_id' => $user->member_id,
            'image_path' => asset('images/kyc_docs') . '/'
        ]);
    }

    public function updateKycStatus(Request $request)
    {
        $request->validate([
            'kyc_id' => 'required|exists:user_kycs,id',
            'doc_type' => 'required|in:aadhar,pan',
            'status' => 'required|in:1,2',
            'reject_reason' => 'nullable|string'
        ]);

        $kyc = \App\Models\UserKyc::find($request->kyc_id);
        
        if ($request->doc_type == 'aadhar') {
            $kyc->aadhar_status = $request->status;
            $kyc->aadhar_reject_reason = $request->status == 2 ? $request->reject_reason : null;
        } else {
            $kyc->pan_status = $request->status;
            $kyc->pan_reject_reason = $request->status == 2 ? $request->reject_reason : null;
        }
        
        $kyc->save();

        return response()->json(['status' => true, 'message' => 'KYC status updated successfully!']);
    }
}
