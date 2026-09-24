<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShoppingApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/purchase/kit',[ShoppingApiController::class,'purchaseKit'])->name('purchasekit');
Route::get('/kits/list',[ShoppingApiController::class,'purchaseKit'])->name('kits.list');

// General Public Settings
Route::get('/referral-settings', [\App\Http\Controllers\Api\SettingController::class, 'getReferralSettings'])->name('api.referral-settings');
Route::get('/app-settings', [\App\Http\Controllers\Api\SettingController::class, 'getAppSettings'])->name('api.app-settings');
Route::get('/loans/public', [\App\Http\Controllers\Api\LoanController::class, 'getPublicLoans'])->name('api.loans.public');

// Authentication Routes
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/check-sponsor', [AuthController::class, 'checkSponsor'])->name('api.checkSponsor');

Route::group(['middleware' => 'auth:sanctum'], function() {
    // Account Management
    Route::get('/account', [AccountController::class, 'accountOverview']);
    Route::post('/tree/all-childs', [\App\Http\Controllers\Api\DashboardController::class, 'getAllChilds']);
    Route::post('/my-transactions', [\App\Http\Controllers\Api\DashboardController::class, 'getTransactions']);
    
    // Payment
    Route::get('/payment-details', [\App\Http\Controllers\Api\PaymentController::class, 'getPaymentDetails']);
    Route::post('/submit-payment', [\App\Http\Controllers\Api\PaymentController::class, 'submitPaymentRequest']);
    
    Route::post('/profile/update', [AccountController::class, 'updateProfile']);
    Route::post('/profile/image', [AccountController::class, 'updateProfileImage']);
    Route::post('/kyc/update', [AccountController::class, 'updateKycDocuments']);
    Route::post('/bank-details/update', [AccountController::class, 'saveBankDetails']);
    Route::post('/change-password', [AccountController::class, 'updatePassword']);
    // Dashboard, Wallet & Transactions
    Route::get('/dashboard', [\App\Http\Controllers\Api\DashboardController::class, 'dashboardSummary']);
    Route::get('/transactions', [\App\Http\Controllers\Api\DashboardController::class, 'transactions']);
    Route::get('/wallet', [\App\Http\Controllers\Api\DashboardController::class, 'wallet']);
    
    // Team & Level Tree
    Route::get('/team', [\App\Http\Controllers\Api\DashboardController::class, 'team']);
    Route::get('/tree', [\App\Http\Controllers\Api\DashboardController::class, 'tree']);
    
    // Loans & EMI
    Route::get('/loans/available', [\App\Http\Controllers\Api\LoanController::class, 'getAvailableLoans']);
    Route::post('/loans/request', [\App\Http\Controllers\Api\LoanController::class, 'requestLoan']);
    Route::get('/loans/my-loans', [\App\Http\Controllers\Api\LoanController::class, 'getMyLoans']);
    Route::get('/loans/emis', [\App\Http\Controllers\Api\LoanController::class, 'emis']);
    Route::post('/loans/emi/pay', [\App\Http\Controllers\Api\LoanController::class, 'payEmi']);

    // RD Plans
    Route::get('/rd-plans', [\App\Http\Controllers\Api\RdController::class, 'index']);
});
