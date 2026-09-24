<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float|null $tds_charges
 * @property float|null $admin_charges
 * @property float|null $direct_amount
 * @property int $pair_amount
 * @property int $capping_of_pair
 * @property int $first_sale_entry_amount
 * @property string|null $id_prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereAdminCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereCappingOfPair($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereDirectAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereFirstSaleEntryAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereIdPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge wherePairAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereTdsCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCharge whereUpdatedAt($value)
 */
	class AdminCharge extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $category_name
 * @property Category|null $parent
 * @property string $category_type
 * @property string $category_images
 * @property string $category_slug
 * @property string $status
 * @property int $is_home
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $subcategory
 * @property-read int|null $subcategory_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $image
 * @property string $slug
 * @property string $duration
 * @property string $description
 * @property string|null $content
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $joining_kit
 * @property string $pin_no
 * @property int|null $transfer_from
 * @property int|null $transfer_to
 * @property int|null $used_by
 * @property string|null $used_at
 * @property string|null $transferred_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JoiningKit|null $joining_kit_rel
 * @property-read \App\Models\User|null $pin_trasnfer_from_rel
 * @property-read \App\Models\User|null $transfer_rel
 * @property-read \App\Models\User|null $used_by_rel
 * @method static \Illuminate\Database\Eloquent\Builder|Epin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereJoiningKit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin wherePinNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereTransferFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereTransferTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereTransferredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epin whereUsedBy($value)
 */
	class Epin extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $joining_kit
 * @property int $pin_no
 * @property int $transfer_from
 * @property int $transfer_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereJoiningKit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory wherePinNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereTransferFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereTransferTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EpinHistory whereUpdatedAt($value)
 */
	class EpinHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $image_path
 * @property string $image_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Image withoutTrashed()
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $kit_image
 * @property string $kit_name
 * @property int|null $kit_pv
 * @property int $amount
 * @property int $is_red
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Epin> $pins
 * @property-read int|null $pins_count
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit query()
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereIsRed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereKitImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereKitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereKitPv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JoiningKit whereUpdatedAt($value)
 */
	class JoiningKit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $kyc_type 1 for Adhar Card, 2 for Voter id, 3 for driving licence, 4 for passport
 * @property string $card_no
 * @property string|null $card_front
 * @property string|null $card_back
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereKycType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDoc whereUserId($value)
 */
	class KycDoc extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property int $left_carry
 * @property int $right_carry
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry query()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereLeftCarry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereRightCarry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCarry whereUserId($value)
 */
	class PairCarry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $pair_count
 * @property int|null $direct_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereDirectCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount wherePairCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PairCount whereUserId($value)
 */
	class PairCount extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property string $tree
 * @property int $pair_count
 * @property float $pair_amount
 * @property float $direct_income
 * @property int $tds
 * @property int $admin_charge
 * @property float $net_amount
 * @property string|null $credit_or_cut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user_rel
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereAdminCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCreditOrCut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereDirectIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout wherePairAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout wherePairCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereTds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereTree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUsername($value)
 */
	class Payout extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $payout_from
 * @property float $payout_amount
 * @property int $from_level
 * @property int $tds
 * @property int $admin_charges
 * @property float $total_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereAdminCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereFromLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary wherePayoutAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary wherePayoutFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereTds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutSummary whereUserId($value)
 */
	class PayoutSummary extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property string $image
 * @property string $pins
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest wherePins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PinRequest whereUserId($value)
 */
	class PinRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property string $position
 * @property string $parent_id
 * @property int $tree_id
 * @property string $direct_of
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDirectOf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereTreeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUserId($value)
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property int $sub_category_id
 * @property string $name
 * @property string $price
 * @property string $description
 * @property string $image
 * @property string|null $discount
 * @property string $quantity
 * @property string|null $delivery_charge
 * @property string|null $sizes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $album
 * @property-read int|null $album_count
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Category|null $subcategory
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSizes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float $pairs
 * @property string $name
 * @property string|null $rank
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reward query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward wherePairs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reward whereUpdatedAt($value)
 */
	class Reward extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $reward_id
 * @property int $pairs
 * @property int $is_given
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Reward|null $reward
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever query()
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereIsGiven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever wherePairs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereRewardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RewardAchiever whereUserId($value)
 */
	class RewardAchiever extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $amount
 * @property string $created_on
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereCreatedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleEntry whereUserId($value)
 */
	class SaleEntry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $profile_picture
 * @property int $user_id
 * @property int $course_id
 * @property string $father_name
 * @property string $mother_name
 * @property string $address
 * @property float $phone
 * @property int $country
 * @property string $district
 * @property string $aadhaar_no
 * @property string $language
 * @property string $qualification
 * @property string $class_type
 * @property string|null $class_center
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAadhaarNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereClassCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereClassType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereMotherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereUserId($value)
 */
	class StudentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property string $tree
 * @property int $pair_count
 * @property float $pair_amount
 * @property float $direct_income
 * @property float $tds
 * @property float $admin_charge
 * @property float $net_amount
 * @property string $credit_or_cut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereAdminCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereCreditOrCut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereDirectIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout wherePairAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout wherePairCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereTds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereTree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnpaidPayout whereUsername($value)
 */
	class UnpaidPayout extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $alter_email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $enc_password
 * @property string $member_id
 * @property string|null $epin
 * @property string|null $parent_string
 * @property float|null $left_count
 * @property int|null $left_child_id
 * @property float|null $right_count
 * @property int|null $right_child_id
 * @property string $sponsor_id direct soponsor of user
 * @property string|null $parent_id under of id
 * @property string $parent_leg parent leg position left or right
 * @property string|null $father_name
 * @property string|null $gender
 * @property string|null $dob
 * @property string|null $mobile
 * @property string|null $email_activation date of email verified
 * @property int $terms status for accept terms and conditions
 * @property int $role user role id
 * @property string|null $remember_token
 * @property int|null $wallet_amount
 * @property int $is_blocked
 * @property int $is_paid
 * @property string|null $user_icon
 * @property int $is_franchise
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RewardAchiever> $achievedRewards
 * @property-read int|null $achieved_rewards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $allChildMembers
 * @property-read int|null $all_child_members_count
 * @property-read \App\Models\UserBankDetail|null $bank_details
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \App\Models\Epin|null $joiningKit
 * @property-read \App\Models\KycDoc|null $kyc_rel
 * @property-read User|null $latestChildMember
 * @property-read User|null $leftChild
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read User|null $parent
 * @property-read \App\Models\Position|null $position_rel
 * @property-read \App\Models\UserProfile|null $profile_rel
 * @property-read User|null $rightChild
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleEntry> $saleEntries
 * @property-read int|null $sale_entries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Epin> $transfer_pin_rel
 * @property-read int|null $transfer_pin_rel_count
 * @property-read \App\Models\Epin|null $used_pin_rel
 * @property-read \App\Models\Role|null $userRole
 * @property-read \App\Models\UserAddress|null $user_address
 * @property-read \App\Models\UserWallet|null $wallet
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlterEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailActivation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEncPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEpin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLeftChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLeftCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereParentLeg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereParentString($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRightChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRightCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSponsorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWalletAmount($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdditionalInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdditionalInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdditionalInfo query()
 */
	class UserAdditionalInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $profile_image
 * @property string|null $father_name
 * @property string|null $mother_name
 * @property string|null $dob
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $pin_code
 * @property string|null $pan_card_number
 * @property string|null $pan_card_image
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $nominee_name
 * @property string|null $nominee_relation
 * @property int $is_pancard_approve 0 for not and 1 for yes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereIsPancardApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereMotherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereNomineeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereNomineeRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePanCardImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePanCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePinCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProfileImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $series
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries whereSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSeries whereUpdatedAt($value)
 */
	class UserSeries extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWallet whereUsername($value)
 */
	class UserWallet extends \Eloquent {}
}

