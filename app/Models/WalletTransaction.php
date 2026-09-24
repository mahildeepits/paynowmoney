<?php

namespace App\Models;

use App\Models\AdminCharge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'keyword',
        'transfered_to',
        'amount',
        'tds',
        'admin_charges',
        'net_amount',
        'pin_no',
        'status',
        'transaction_id',
    ];

    protected $casts = [
        'amount' => 'integer',
        'tds' => 'integer',
        'admin_charges' => 'integer',
        'net_amount' => 'integer',
    ];

    protected $appends = [
        'slug',
    ];

    // New protected array for keywords and names
    protected $keywordNames = [
        // 'self_transfer_direct_income'      => 'Self Transfered Direct Income',
        // 'self_transfer_level'       => 'Self Transfered Team /Level',
        // 'self_transfer_autopool'    => 'Self Transfered AutoPool Income',
        // 'buy_pin'                   => 'Pin Purchased ',
        // 'transfer'                  => 'Transfered Money To',
        // 'self_topup'                => 'Self Topup',
        // 'user_topup'                => 'User topup',
        // 'pin_transfer'              => 'Received Money From ',
        'withdrawal'                => 'Withdrawal',
        'withdrawal_refund'         => 'Withdrawal Refunded',
        'direct_income'             => 'Direct Income',
        'level_income'              => 'Level Income',
        // 'autopool_income'           => 'AutoPool Income',
        'reward_income'             => 'Reward Income',
        // 'charity_income'            => 'Charity Income',
    ];

    public function getKeywordNames()
    {
        return $this->keywordNames;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','member_id');
    }
    public function transferedTo(){
        return $this->belongsTo(User::class,'transfered_to','member_id');
    }
    public function epin() {
        return $this->belongsTo(Epin::class, 'pin_no', 'pin_no');
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = round($value);
        
        // Use provided keyword or fallback to null
        $keyword = $this->attributes['keyword'] ?? null;

        if ($keyword == 'withdrawal') {
            $adminCharge = AdminCharge::first();
            $tds = round(($value * ($adminCharge->tds_charges ?? 0)) / 100);
            $admin_charges = round(($value * ($adminCharge->admin_charges ?? 0)) / 100);
            $net_amount = round($value - $tds - $admin_charges);

            // Set these ONLY if they are not already manually provided
            if (!isset($this->attributes['tds'])) {
                $this->attributes['tds'] = $tds;
            }
            if (!isset($this->attributes['admin_charges'])) {
                $this->attributes['admin_charges'] = $admin_charges;
            }
            if (!isset($this->attributes['net_amount'])) {
                $this->attributes['net_amount'] = $net_amount;
            }
        } else {
            if (!isset($this->attributes['net_amount'])) {
                $this->attributes['net_amount'] = round($value);
            }
        }
    }

    public function getSlugAttribute() {
        $transactionText = 'N/A';
        // Generate transaction text based on the keyword
        if (isset($this->keywordNames[$this->keyword])) {
            $transactionText = $this->keywordNames[$this->keyword];
            if ($this->keyword === 'buy_pin') {
                $transactionText = "$transactionText: {$this->pin_no}";
            } elseif ($this->keyword === 'transfer') {
                if (authUser()->member_id == $this->transfered_to) {
                    $transactionText = "Received Money From  {$this?->user?->name}";
                } else {
                    $transactionText = "$transactionText {$this->transferedTo->member_id} ({$this->transferedTo->name})";
                }
            } elseif ($this->keyword === 'self_topup') {
                // Assuming you have a relation to get the joining kit
                $joiningKitName = $this?->epin?->joining_kit_rel?->name ?? 'Unknown Kit'; // Adjust based on your relationships
                $transactionText = "Self Topup with $joiningKitName Kit";
            } elseif ($this->keyword === 'user_topup') {
                // Assuming you have a relation to get the used_by user and joining kit
                $usedByUser = User::find($this?->epin?->used_by); // Adjust based on your actual field
                $joiningKitName = $this?->epin?->joining_kit_rel?->name ?? 'Unknown Kit'; // Adjust based on your relationships
                $transactionText = "User ({$usedByUser->member_id}) Topup with $joiningKitName Kit"; // Adjust based on your actual field
            } else if ($this->keyword == 'pin_transfer') {
                $transactionText = "$transactionText: {$this->user->name}";
            }
        } else if (strpos($this->keyword, 'self_transfer_level_') === 0) {
            $level = str_replace('self_transfer_level_', '', $this->keyword);
            $transactionText = "Self Transfered Level $level Income";
        } else if (strpos($this->keyword, 'level_') === 0 && strpos($this->keyword, '_income') !== false) {
            $level = str_replace(['level_', '_income'], '', $this->keyword);
            $transactionText = "Level $level Income";
        }

        return $transactionText;
    }
}
