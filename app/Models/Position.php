<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','position','parent_id','tree_id'];

    public static function getUsernameByPositionParentId($parent,$position){
        if($parent == false || $parent == null){
            return false;
        }
        $position = self::with(['user.joiningKit.joining_kit_rel'])->where(['parent_id'=>$parent,'position'=>$position,'tree_id'=>request()->number])->first();
        if($position != null){
            return $position;
        }else{
            return false;
        }
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','member_id');
    }

//    public static function findPosition($userId,$position){
//        $countUserArray = [];
//        $users = [];
//        $userPositionModel = self::with(['user'])->where(['parent_id'=>$userId,'position'=>$position,'tree_id'=>1])->first();
//        if($userPositionModel != null){
//            $users[] = $userPositionModel;
//            $countUserArray[] = $userPositionModel->user_id;
//            for($i = 0; $i < count($countUserArray); $i++){
//                $userPositionLeftRight = self::with(['user'])->whereIn('position',['left','right'])
//                    ->where(['parent_id'=>$countUserArray[$i],'tree_id'=>1])->get();
//                if(!$userPositionLeftRight->isEmpty()){
//                    foreach($userPositionLeftRight as $uKeys => $userIds){
//                        $countUserArray[] = $userIds->user_id;
//                        $users[] = $userIds;
//                    }
//                }
//            }
//        }
//        return $users;
//    }

    public static function findPosition($userId,$position){
        $countUserArray = [];
        $users = [];
        $userPositionModel = self::with(['user'])->where(['parent_id'=>$userId,'position'=>$position,'tree_id'=>1])->first();
        if($userPositionModel != null){
            $users[] = $userPositionModel;
            $countUserArray[] = $userPositionModel->user_id;
            foreach($countUserArray as $key => &$userId){
                $userPositionLeftRight = self::with(['user'])->whereIn('position',['left','right'])
                    ->where(['parent_id'=>$userId,'tree_id'=>1])->get();
                if(!$userPositionLeftRight->isEmpty()){
                    foreach($userPositionLeftRight as $uKeys => $userIds){
                        $countUserArray[] = $userIds->user_id;
                        $users[] = $userIds;
                    }
                }
            }
        }
        return $users;
    }

//     public static function findPosition($userId,$position){
//         $countUserArray = [];
//         $users = [];
//         $position = 'right';
//         $userPositionModel = self::with(['user'])->where(['parent_id'=>$userId,'position'=>$position,'tree_id'=>1])->first();
//         if($userPositionModel != null){
//             $users[] = $userPositionModel->toArray();
//             $countUserArray[] = $userPositionModel->user_id;
//             $allPositions = self::with(['user'])->where(['tree_id'=>1])->where('user_id','!=',$userId)->get();
//             for($i = 0; $i < count($countUserArray); $i++){
//                 $newUsers = $allPositions->whereIn('position',['left','right'])->where('tree_id',1)->where('parent_id',$countUserArray[$i]);
//                 $countUserArray = array_merge($countUserArray,$newUsers->groupBy('user_id')->keys()->toArray());
//                 $users = array_merge($users,$newUsers->values()->toArray());
//             }
//         }
//         return $users;
//     }

    public static function treeStatus($userId){
        $userPosition = self::select(['tree_id'])->where(['status'=>1,'user_id'=>$userId])->get();
        return $userPosition->count();
    }
}
