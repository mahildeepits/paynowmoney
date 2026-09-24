<?php
if(!function_exists('get_user_by_position')){
    function get_user_by_position($username,$position){
        return \App\Models\Position::getUsernameByPositionParentId($username,$position);
    }
}

if(!function_exists('hasMenu')){
    function hasMenu($menuArray): bool
    {
        return in_array(request()->route()->getName(),$menuArray);
    }
}

if(!function_exists('getAdminCharges')){
    function getAdminCharges($chargeType)
    {
        $adminCharges = \App\Models\AdminCharge::first();
        return $adminCharges[$chargeType];
    }
}
