<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Epin;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Http\Controllers\Api\CouponCodeController;

class GenerateMonthlyCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:monthly-coupon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->line("\e[1m \e[33m -- Generating Monthly Coupon -- \e[0m ");
        $users = User::where('role', 3)->get();
        $now = Carbon::now(); // Current date and time
        $couponsAmount = [
            '10500' => [
                'amount' => 500,
                'max_months' => 60,
            ],
            '105000' => [
                'amount' => 10000,
                'max_months' => 30,
            ],
        ];
        foreach ($users as $user) {
            $latestJoiningKit = $user->latestJoiningKit;
            if ($latestJoiningKit && $latestJoiningKit->amount != '2150') {
                $couponArray = $couponsAmount[$latestJoiningKit->amount];
                $discountAmount = $couponArray['amount'];
                $maxMonths = $couponArray['max_months'];

                $latestCouponDate = $user->last_coupon_date;
                $totalMonths = $user->total_months;
                $createdAt = $latestCouponDate ? Carbon::parse($latestCouponDate) : Carbon::parse($user->created_at);
                $nextCouponDate = $createdAt->copy()->addMonth(); // Calculate the next coupon generation date
                if ($now->isSameDay($nextCouponDate) && $totalMonths <= $maxMonths) {
                    $coupon = self::addDirectInDataBase($user, $discountAmount);
                    if ($coupon['status'] == true) {
                        $user->last_coupon_date = $now->format('Y-m-d');
                        $user->total_months = $totalMonths + 1;
                        $user->save();
                    }
                }
            }
        }
    }

    public static function generateMonthlyCoupon($user, $discountAmount){
        $client = new Client();
        $now = Carbon::now(); // Current date and time
        $url = config('app.api_url').'/api/coupon';
        $formData = [
            'coupon_type' => 'discount_on_purchase',
            'title' => 'Full value return coupon',
            'code' => generateCode(),
            'coupon_bearer' => 'inhouse',
            'seller_id' => 0,
            'customer_id' => $user->customer_id,
            'limit' => 1,
            'discount_type' => 'amount',
            'discount' => $discountAmount,
            'min_purchase' => 0,
            'max_discount' => $discountAmount,
            'start_date' => $now->format('Y-m-d'),
            'expire_date' => $now->copy()->addMonth()->format('Y-m-d'),
            'email' => $user->email ?? null,
        ];
        try {
            $response = $client->post($url, [
                'form_params' => $formData,
            ]);
            $responseBody = $response->getBody()->getContents();
            $responseJson = json_decode($responseBody, true);
            return $responseJson;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse();
                $errorBody = $errorResponse->getBody()->getContents();
                return response()->json(['error' => $errorBody], $errorResponse->getStatusCode());
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['status' => true], 200);
    }

    public static function addDirectInDataBase($user, $discountAmount){
        DB::beginTransaction();
        $now = Carbon::now(); // Current date and time
        try {
            DB::connection('ecommerce')->table('coupons')->insert([
                'coupon_type' => 'discount_on_purchase',
                'title' => 'Full value return coupon',
                'code' => generateCode(),
                'coupon_bearer' => 'inhouse',
                'seller_id' => 0,
                'customer_id' => $user->customer_id,
                'limit' => 1,
                'discount_type' => 'amount',
                'discount' => $discountAmount,
                'min_purchase' => 0,
                'max_discount' => $discountAmount,
                'start_date' => $now->format('Y-m-d'),
                'expire_date' => $now->copy()->addMonth()->format('Y-m-d'),
            ]);

            DB::commit();
            return ['status' => true];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => false,'message' => $th->getMessage()];
        }
    }
}
