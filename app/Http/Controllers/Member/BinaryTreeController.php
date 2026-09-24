<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\AdminCharge;
use App\Models\UserSeries;
use App\Models\UserAdditionalInfo;
use App\Helpers\RewardHelper;

class BinaryTreeController extends Controller
{
    public function index($treeId = 1){
//        $user = User::find(7);
//        dd($user->getLeftCount());
        $loggedInUser = \Auth::guard('member')->user();
        // $user = User::find(314);
        // RewardHelper::settlePreviousAutopool($user,4);
        // dd('here');
        return view('binary-tree.index', compact('loggedInUser'));
    }

    public function tree(Request $request, $number){
        // dd($request->all());
        $username = User::where('member_id',$request->username)->first();
        $loggedInUser = \Auth::guard('member')->user()->member_id;
        $parent_role = $username?->userRole?->name ?? null;
        $child_role = $username?->latestChildMember?->userRole?->name ?? null;
        // if($request->has('username')){
        //     $username = $username->where(['member_id'=>$request->username])->first();
        // }else{
        //     $username = $username->where(['member_id'=>$loggedInUser])->first();
        // }
        if($request->has('username')){
            $previousUser = ($username->sponsor_id == null || $request->username == $loggedInUser)? false : $username->parent_id;
            // $previousUser = Position::where(['user_id'=>$username->member_id,'tree_id'=>1])->first();
            // if($previousUser != null){
            //     if($username->member_id == $previousUser->direct_of ||
            //         $previousUser->parent_id == 'Company' || $request->username == $loggedInUser){
            //         $previousUser = false;
            //     }else{
            //         $previousUser = $previousUser->direct_of;
            //     }
            // }
        }else{
            $previousUser = false;
        }
        return view('binary-tree.treeNew',['loggedInUser'=>$username,'previousUser'=>$previousUser,'parent_role' => $parent_role,'child_role' => $child_role]);
    }

    public function updateLeftRightCount(){
        $positions = Position::where(['tree_id'=>1])->where('parent_id','!=','Company')->get();
        foreach($positions as $key => $user){
            $sponsor = $user->parent_id;
            $position = $user->position;
            while($sponsor != 'Company'){
                $userParent = User::with(['position_rel'])->where(['member_id'=>$sponsor])->first();
                if($position == 'left'){
                    $userParent->left_count = $userParent->left_count + 1;
                    $userParent->save();
                }else{
                    $userParent->right_count = $userParent->right_count + 1;
                    $userParent->save();
                }
                $sponsor = $userParent->position_rel->parent_id;
                $position = $userParent->position_rel->position;
                if($sponsor == 'SSB00001' && $position == 'right'){
                    dd($userParent,$user,$sponsor,$position);
                }
            }
        }
    }


    public function myDirects(){
        $directs = User::whereSponsorId(\Auth::guard('member')->user()->member_id)->get();
        return view('binary-tree.directs',compact('directs'));
    }

    public function downline(){
        $downline = [];
        $user = \Auth::guard('member')->user()->member_id;
        $childs = getSponsoredChilds([$user]);
        return view('binary-tree.downline',compact('childs'));
    }
    public function usersByRole(Request $request){
        $role_id = $request->role_id ?? null;
        $role = Role::find($role_id);
        $users = [];
        if($role != null){
            $parentLevel = ($role->level - 1);
            $users = User::whereNotNull('parent_id')->whereHas('userRole',function($subQuery)use($parentLevel){
                return $subQuery->where('level',$parentLevel);
            })->get()->pluck('member_id','member_id')->toArray();
        }
        return view('admin.roles.parent-users',compact('users'));
    }
    public function addMember(){
        if(auth()->guard('member')->user()->userRole->for_admin == 1){
            return view('binary-tree.user-form');
        }
        abort(403,"You does'nt have permission");
    }
    public function storeMember(Request $request){
        $adminSettings = AdminCharge::first();
        $userSeries = UserSeries::first();
        $authController = new AuthController;
        $request->validate([
            'role' => 'required',
            'sponsor_id' => 'required',
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'education' => 'required',
            'tech_education' => 'required',
            'language' => 'required',
            'skills' => 'required',
            'experiences' => 'required',
            'inspirations' => 'required',
        ]);
        $data = $request->only('role','sponsor_id','name','email','mobile');
        $data['password'] = \Hash::make($request->password);
        $data['enc_password'] = \Crypt::encrypt($request->password);
        $data['is_paid'] = 0;
        $data['user_icon'] = 'userunpaid.png';
        $data['parent_id'] = $request->sponsor_id;
        $data['member_id'] = $adminSettings->id_prefix . str_pad($userSeries->series, 5, 0, STR_PAD_LEFT);
        $data['parent_leg'] = 'left';
        $additionalInfo = $request->only('education','tech_education','language','skills','experiences','inspirations');
        try {
            $user = User::create($data);
            if($user){
                $additionalInfo['user_id'] = $user->id;
                $userSeries->series = $userSeries->series + 1;
                $userSeries->save();
                $authController->updateParentString($user);
                UserAdditionalInfo::create($additionalInfo);
                return ['status' => true,'message' => 'Member Added Successfully'];
            }
            throw new Exception("Error Processing Request", 1);

        } catch (\Throwable $th) {
            return ['status' => false,'message' => $th->getMessage()];
        }

    }
    public function replaceTree(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'parent_id' => 'required',
                'user_id' => 'required',
            ],[
                'parent_id.required' => 'This field is required',
                'user_id.required' => 'This field is required',
            ]);
            $parent_user = User::where('member_id',$request->parent_id)->first();
            if($parent_user == null){
                return back()->withErrors(['parent_id'=>'Parent user not found'])->withInput();
            }
            $user = User::where('member_id',$request->user_id)->first();
            if($user == null){
                return back()->withErrors(['user_id'=>'Replace user not found'])->withInput();
            }
            if($user->sponsor_id != 'Company' && $user->sponsor_id != 'company'){
                return back()->withErrors(['user_id'=>'This user tree can`t be replaced'])->withInput();
            }
            changeTree($parent_user,$user);
            \Session::flash('success','Success|Tree Replaced successfully!');
            return back();
        }
        return view('binary-tree.replace-tree');
    }
}
