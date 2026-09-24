<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Payout;
use App\Models\Reward;
use App\Models\UserPayout;
use App\Models\AdminCharge;
use App\Models\LevelPayout;
use App\Models\AutopoolIncome;
use App\Models\RewardAchiever;
use App\Models\RegisterationBonus;

class RewardHelper
{
    public static function giveRewards()
    {
        $rewards = self::getRewards();
        foreach($rewards as $k => $singleReward){
            $users = User::where('left_count','>=',$singleReward->pairs)
                ->where('right_count','>=',$singleReward->pairs)->with(['achievedRewards'])->get();
            foreach($users as $index => $user){
                $isRewardAlreadyGiven = $user->achievedRewards->where('pairs',$singleReward->pairs)->count();
                if($isRewardAlreadyGiven == 0){
                    self::saveRewardAchiever($user,$singleReward);
                }
            }
        }
    }

    /**
     * Distribute rewards based on EMI approvals.
     * This function iterates up the sponsor tree and checks if current sponsor
     * qualifies for a reward based on counts of descendants at the trigger user's relative level.
     * 
     * @param \App\Models\User $user The user whose EMI was approved
     */
    public static function distributeEmiRewards($user)
    {
        $currentSponsorMemberId = $user->sponsor_id;

        while ($currentSponsorMemberId) {
            $sponsor = User::where('member_id', $currentSponsorMemberId)->first();
            if (!$sponsor) break;

            // Evaluate this sponsor for any rewards they qualify for
            self::checkAndGiveEmiRewards($sponsor);

            // Move up to the next sponsor in the referral chain
            $currentSponsorMemberId = $sponsor->sponsor_id;
        }
    }

    /**
     * Check if a sponsor qualifies for any rewards and save achievements.
     */
    public static function checkAndGiveEmiRewards($sponsor)
    {
        // Get all rewards ordered by id in ascending order
        $rewards = Reward::orderBy('id', 'asc')->get();
        if ($rewards->isEmpty()) {
            return;
        }

        // Find the Level 1 reward to check for downline achievers
        $level1Reward = Reward::where('name', 'like', 'Level 1')->first();
        if (!$level1Reward) {
            // Fallback to the first reward if name differs
            $level1Reward = $rewards->first();
        }

        // Get sponsor descendants info
        $descendantsInfo = self::getSponsorDescendantsInfo($sponsor);
        $descendantMemberIds = $descendantsInfo['member_ids'];
        $descendantUserIds = $descendantsInfo['user_ids'];

        if (empty($descendantMemberIds)) {
            return;
        }

        // Count descendants (any depth) who have at least one approved EMI and is_paid = 1
        $totalTeamCount = User::where('is_paid', 1)
            ->whereIn('member_id', $descendantMemberIds)
            ->whereHas('emis', function($query) {
                $query->where('status', 'approved');
            })
            ->count();

        foreach ($rewards as $reward) {
            // Check if this sponsor has already achieved this specific reward
            $alreadyAchieved = RewardAchiever::where('user_id', $sponsor->id)
                ->where('reward_id', $reward->id)
                ->exists();

            if ($alreadyAchieved) {
                continue;
            }

            // Check if team count is sufficient
            if ($totalTeamCount < $reward->pairs) {
                // If they don't meet the count for this level, they won't meet it for higher levels
                break;
            }

            // Parse level number from name (e.g. "Level 2" or "LEVEL 2" -> 2)
            $levelNumber = 1;
            if (preg_match('/level\s+(\d+)/i', $reward->name, $matches)) {
                $levelNumber = (int)$matches[1];
            }

            // Check the downline achievement condition (Option 2)
            // For Level N (where N = $levelNumber), it requires at least (N - 1) Level 1 achievers
            if ($levelNumber > 1 && $level1Reward) {
                $requiredLevel1AchieversCount = $levelNumber - 1;

                // Count unique users in descendants who have achieved Level 1 reward
                $achievedLevel1Count = RewardAchiever::whereIn('user_id', $descendantUserIds)
                    ->where('reward_id', $level1Reward->id)
                    ->count();

                if ($achievedLevel1Count < $requiredLevel1AchieversCount) {
                    // Does not qualify for this level
                    continue;
                }
            }

            // Sponsor qualifies! Save achievement and generate reward income
            self::saveRewardAchiever($sponsor, $reward);
        }
    }

    /**
     * Helper to count descendants at a specific depth who have at least one approved EMI.
     */
    public static function countDescendantsAtDepthWithApprovedEmi($sponsor, $depth)
    {
        $currentNodes = [$sponsor->member_id];
        
        for ($i = 0; $i < $depth; $i++) {
            $currentNodes = User::whereIn('sponsor_id', $currentNodes)
                ->pluck('member_id')
                ->toArray();
            if (empty($currentNodes)) return 0;
        }

        // Return count of unique users at this depth with at least one approved EMI
        return User::where('is_paid',1)->whereIn('member_id', $currentNodes)
            ->whereHas('emis', function($query) {
                $query->where('status', 'approved');
            })
            ->count();
    }

    /**
     * Helper to get all direct and indirect descendants (full depth) of a sponsor in the sponsor tree.
     * Returns an array with 'member_ids' and 'user_ids'.
     */
    public static function getSponsorDescendantsInfo($sponsor)
    {
        $allDescendantMemberIds = [];
        $allDescendantUserIds = [];
        $currentLevelMemberIds = [$sponsor->member_id];
        $visited = [$sponsor->member_id => true];

        while (!empty($currentLevelMemberIds)) {
            $children = User::whereIn('sponsor_id', $currentLevelMemberIds)
                ->select('id', 'member_id')
                ->get();
                
            if ($children->isEmpty()) {
                break;
            }

            $nextLevelMemberIds = [];
            foreach ($children as $child) {
                if (!isset($visited[$child->member_id])) {
                    $visited[$child->member_id] = true;
                    $allDescendantMemberIds[] = $child->member_id;
                    $allDescendantUserIds[] = $child->id;
                    $nextLevelMemberIds[] = $child->member_id;
                }
            }
            
            $currentLevelMemberIds = $nextLevelMemberIds;
        }

        return [
            'member_ids' => $allDescendantMemberIds,
            'user_ids' => $allDescendantUserIds
        ];
    }

    public static function getRewards(){
        return Reward::get();
    }

    public static function addWalletIncome($user, $amount, $type)
    {
        if ($amount <= 0) return;
        
        \App\Models\UserPayout::create([
            'user_id' => $user->id,
            'income_type' => $type,
            'amount' => $amount,
            'tds' => 0,
            'admin_charges' => 0,
            'net_amount' => $amount,
            'is_requested' => now(), // Mark as already moved/available in wallet
        ]);

        \App\Models\WalletTransaction::create([
            'user_id' => $user->member_id,
            'keyword' => $type . '_income',
            'amount' => $amount,
        ]);
    }

    public static function saveRewardAchiever($user,$reward): RewardAchiever
    {
        $modelObject = new RewardAchiever;
        $modelObject->user_id = $user->id;
        $modelObject->reward_id = $reward->id;
        $modelObject->pairs = $reward->pairs;
        $modelObject->save();

        if($reward->amount > 0){
            self::addWalletIncome($user, $reward->amount, 'reward');
        }
        return $modelObject;
    }

    public static function studentRegIncentive($userId){
        $adminCharge = AdminCharge::first();
        $student = User::find($userId);
        $sponsor = $student->sponsor;
        if($sponsor != null){
            $payout = Payout::where('username',$sponsor->member_id)->get()->last();
            $pair_amount = 200;
            $tds = round((200*$adminCharge->tds_charges)/100);
            $admin_charges = round((200*$adminCharge->admin_charges)/100);
            $net_amount = round((200 - $tds) - $admin_charges);
            if($payout != null && $payout->pair_count < 60){
                $payout_count = $payout->pair_count + 1;
                $payout->update(['pair_count' => $payout_count]);
                
                self::addWalletIncome($sponsor, 200, 'direct');

                if($payout_count == 60){
                    self::registerBonus($sponsor,$sponsor->payouts->count());
                    self::registerBonus($sponsor->sponsor);
                    self::upperLevelBonus($sponsor->sponsor);
                }
            }else{
                Payout::create([
                    'username' => $sponsor->member_id,
                    'tree' => 1,
                    'pair_count' => 1,
                    'pair_amount' => $pair_amount,
                    'direct_income' => 0,
                    'tds' => 0,
                    'admin_charge' => 0,
                    'net_amount' => $pair_amount,
                ]);
                self::addWalletIncome($sponsor, 200, 'direct');
            }
        }
    }
    public static function upperLevelBonus($user){
        $roles = [
            4 => 100000,  // district field officer
            3 => 20000,  // district team manager
            2 => 20000,  //  admin
        ];  // role_id => amount

        foreach ($roles as $role => $amount) {
            $count = User::where('sponsor_id',$user->sponsor_id)->where('role',$user->role)->whereHas('regisBonus',function($query)use($amount){
                $query->select(\DB::raw('SUM(bonus_amount) as total_bonus'))
                      ->groupBy('user_id')
                      ->having('total_bonus', '>=', $amount);
            })->get()->count();
            $index = 0;
            while ($count >= 5) {
                $index = $index + 1;
                self::registerBonus($user->sponsor,$index);
                $count = $count - 5;
            }
            $user = $user->sponsor;
        }
    }
    public static function registerBonus($user,$index = null){
        $adminCharge = AdminCharge::first();
        $bonus_amount = 20000;
        if($index != null){
            $bonus_amount = 20000 * $index;
        }

        $tds = round(($bonus_amount*$adminCharge->tds_charges)/100);
        $admin_charges = round(($bonus_amount*$adminCharge->admin_charges)/100);
        $net_amount = round(($bonus_amount - $tds) - $admin_charges);
        RegisterationBonus::updateOrCreate([
            'user_id' => $user->id,
        ],[
            'bonus_amount' => $bonus_amount,
            'tds' => 0,
            'admin_charges' => 0,
            'net_amount' => $bonus_amount,
        ]);
    }
    public static function levelIncome($user_id){
        $adminCharge = AdminCharge::first();
        if($user_id != null){
            $user = User::find($user_id);
            $kit = $user->latestJoiningKit ?? null;
            $user = $user->sponsor;
            $levelIncome = [
                2 => 50,
                3 => 50,
                4 => 50,
                5 => 50,
                6 => 20,
                7 => 20,
                8 => 20,
                9 => 20,
                10 => 20,
                11 => 20,
                12 => 20,
                13 => 20,
                14 => 20,
                15 => 20,
                16 => 10,
                17 => 10,
                18 => 10,
                19 => 10,
                20 => 10,
                21 => 10,
                22 => 10,
                23 => 10,
                24 => 10,
                25 => 10,
            ]; // level => income
            foreach ($levelIncome as $level => $income) {
                if($user != null){
                    if($user->sponsor != null){
                        $user = $user->sponsor;
                        $level_income = $income;
                        if($kit != null){
                            if($level >= 2 && $level <= 5){
                                $level_income = $kit->level2_5;
                            }elseif($level >= 6 && $level <= 15){
                                $level_income = $kit->level6_15;
                            }elseif ($level >= 16 && $level <= 25) {
                                $level_income = $kit->level16_25;
                            }
                        }
                        self::addWalletIncome($user, $level_income, 'level_'.$level);
                    }
                }
            }
        }
    }

    public static function directIncome($user_id){
        $adminCharge = AdminCharge::first();
        $user = User::with(['latestJoiningKit','sponsor'])->where('id',$user_id)->first();
        if($user != null){
            $kit = $user->latestJoiningKit ?? null;
            $user = $user->sponsor;
            $direct_amount = $kit->direct_income ?? 0;
            $amount = $direct_amount;
            $tds = round(($amount * $adminCharge->tds_charges)/100);
            $admin_charges = round(($amount * $adminCharge->admin_charges)/100);
            $net_amount = round(($amount - $tds) - $admin_charges);
            self::addWalletIncome($user, $amount, 'direct');
        }
    }
    public static function sponsorIncome($user_id){
        $adminCharge = AdminCharge::first();
        $user = User::with(['latestJoiningKit','sponsor'])->where('id',$user_id)->first();
        $amount = $user->latestJoiningKit->level2_5;
        $tds = round(($amount * $adminCharge->tds_charges)/100);
        $admin_charges = round(($amount * $adminCharge->admin_charges)/100);
        $net_amount = round(($amount - $tds) - $admin_charges);
        $sponsor = $user->sponsor;
        for ($i=0; $i < 6; $i++) { 
            if($sponsor != null){
                self::addWalletIncome($sponsor, $amount, 'level');
            }
            $sponsor = $sponsor->sponsor ?? null;
        }
    }
    public static function charityIncome($user_id){    
        $adminCharge = AdminCharge::first();
        $user = User::with(['latestJoiningKit','sponsor'])->where('id',$user_id)->first();
        $amount = $user?->latestJoiningKit?->bonus_amount ?? 0;
        $tds = round(($amount * $adminCharge->tds_charges)/100);
        $admin_charges = round(($amount * $adminCharge->admin_charges)/100);
        $net_amount = round(($amount - $tds) - $admin_charges);    
        $charityUsers = User::whereIn('member_id',['CH0001','CH0002'])->get();
        foreach ($charityUsers as $user) {
            self::addWalletIncome($user, $amount, 'charity');
        }
    }
    public static function autopoolIncome($user_id){
        $user = User::with(['latestJoiningKit','sponsor'])->where('id',$user_id)->first();
        $autoPool = $user->latestJoiningKit->autoPool;
        $counts = [
            1 => 'count_4',
            2 => 'count_16',
            3 => 'count_64',
            4 => 'count_256',
            5 => 'count_1024',
            6 => 'count_4096',
            7 => 'count_16384',
        ];
        $sponsor = $user->sponsor;
        $userCount = 4;
        foreach($counts as $level => $column){
            $olderAutopoolIncome = null;
            $autopoolIncome = AutopoolIncome::where('autopool_id',$autoPool->id)->where('level',$level)->where('user_id',$sponsor->id)->latest()->first();
            if($level >= 2){
                $olderAutopoolIncome = AutopoolIncome::where('autopool_id',$autoPool->id)->where('level',($level - 1))->where('user_id',$sponsor->id)->latest()->first();
            }
            if($olderAutopoolIncome != null){
                $sameKitSponsorChilds = $user->sponsor->childs->toQuery()->where('is_paid',1)->whereHas('latestJoiningKit',function($query)use($autoPool){
                    return $query->where('autopool_id',$autoPool->id);
                })->count();
                if(!in_array($user->sponsor->id,$olderAutopoolIncome->child_ids)){
                    break;
                }else if($sameKitSponsorChilds > 4){
                    break;
                }
            }
            $is_eligible = false;
            $sponsorAutopoolIds = $sponsor?->joiningKits->pluck('autopool_id')->toArray() ?? [];
            if(in_array($autoPool->id,$sponsorAutopoolIds) || $sponsor->member_id == 'Company'){
                $is_eligible = true;
            }
            if($is_eligible){
                if($autopoolIncome != null){
                    if(count($autopoolIncome->child_ids) < $userCount){
                        $currentChild_ids = $autopoolIncome->child_ids;
                        if(!in_array($user->id,$currentChild_ids)){
                            array_push($currentChild_ids,$user->id);
                            $autopoolIncome->update([
                                'income' => ($autopoolIncome->income != null)? round($autopoolIncome->income + $autoPool->$column) : $autoPool->$column,
                                'child_ids' => ($autopoolIncome->child_ids != null)? $currentChild_ids : [$user->id],
                            ]);
                        }
                    }
                }else{
                    $data = [
                        'user_id' => $sponsor->id,
                        'income' => $autoPool->$column,
                        'level' => $level,
                        'child_ids' => [$user->id],
                        'autopool_id' => $autoPool->id,
                    ];
                    AutopoolIncome::create($data);
                }
            }
            if(count($sponsorAutopoolIds) > 1 && $sponsor->latestJoiningKit->autopool_id != $autoPool->id){
                self::settlePreviousAutopool($sponsor,$autoPool->id);
            }
            $sponsor = $sponsor->sponsor;
            $userCount = $userCount*4;
            if($sponsor == null){
                break;
            }
        }
    }
    public static function settlePreviousAutopool($user,$autopool_id){
        $adminCharge = AdminCharge::first();
        $autopoolIncomes = AutopoolIncome::where('user_id',$user->id)->where('autopool_id',$autopool_id)->orderBy('level','asc')->get();
        $olderPayouts = UserPayout::where('user_id',$user->id)->where('income_type','autopool')->where(function($query){
            return $query->whereNotNull('is_requested')->orWhereNotNull('is_paid');
        })->get();
        $income = getMatchedAutoPoolIncome($autopoolIncomes);
        if($olderPayouts->count() > 0) {
            $amount = round($income - $olderPayouts->sum('amount'));
        }else {
            $amount = round($income);
        }
        $tds = round(($amount * $adminCharge->tds_charges)/100);
        $admin_charges = round(($amount * $adminCharge->admin_charges)/100);
        $net_amount = round(($amount - $tds) - $admin_charges);
        self::addWalletIncome($user, $amount, 'autopool');
    }
}
