<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\Member\PinController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\PancardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RewardsController;
use App\Http\Controllers\Member\PayoutController;
use App\Http\Controllers\Admin\AutopoolController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Member\AccountController;
use App\Http\Controllers\Admin\MemberViewController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\SaleEntryController;
use App\Http\Controllers\Admin\JoiningKitsController;
use App\Http\Controllers\Member\BinaryTreeController;
use App\Http\Controllers\Admin\WelcomeLetterController;
use App\Http\Controllers\Admin\WebsiteSettingsController;
use App\Http\Controllers\Member\StudentRegistrationController;
use App\Http\Controllers\Admin\PinController as AdminPinController;
use App\Http\Controllers\Admin\PayoutController as PayoutControllerAlias;
use App\Http\Controllers\Admin\Auth\AuthController as AuthControllerAlias;
use App\Http\Controllers\Member\RewardsController as RewardsControllerAlias;
use App\Http\Controllers\Admin\DashboardController as DashboardControllerAlias;
use App\Http\Controllers\Admin\SaleEntryController as AdminSaleEntryController;
use App\Http\Controllers\Admin\UserPayoutController;
use App\Http\Controllers\Member\WalletTransactionController;
use App\Http\Controllers\Member\EmiController;
use App\Http\Controllers\Admin\EmiController as AdminEmiController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Admin\LevelIncomeController;
use App\Http\Controllers\Admin\MemberFeaturesController;
use App\Http\Controllers\Admin\SelectionProductController as AdminSelectionProductController;
use App\Http\Controllers\Member\SelectionProductController as MemberSelectionProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('generate-payout',[AuthController::class,'generatePayoutIds']);
Route::get('fix/userenc',function(){
    $enc_password = encrypt('123456');
    $hash_password = \Hash::make('123456');
    $users = User::all();
    $errors = [];
    foreach ($users as $user) {
       try {
            $user->update(['password' => $hash_password,'enc_password' => $enc_password]);
       } catch (\Throwable $th) {
            $errors[$user->id] = $th->getMessage();
       }
    }
    dd($errors);
});

//Admin Route
Route::get('/',function(){
    return redirect('admin');
});
Route::group(['prefix'=>'admin'], function (){
    Route::get('login',[AuthControllerAlias::class,'loginForm'])->name('admin.login');
    Route::post('login',[AuthControllerAlias::class,'login'])->name('admin.login');
    Route::group(['middleware'=>'admin_auth'], function(){
        Route::get('/',[DashboardControllerAlias::class,'index'])->name('admin.dashboard');

        // Payment Methods & Requests
        Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class, ['as' => 'admin']);
        Route::get('payment-requests', [\App\Http\Controllers\Admin\PaymentRequestController::class, 'index'])->name('admin.payment-requests.index');
        Route::post('payment-requests/{id}/status', [\App\Http\Controllers\Admin\PaymentRequestController::class, 'updateStatus'])->name('admin.payment-requests.status');

        Route::get('joining/kits',[JoiningKitsController::class,'joiningKits'])->name('joining.kits');
        Route::post('joining/kits',[JoiningKitsController::class,'saveJoiningKits'])->name('joining.kits');
        Route::get('joining/kit/delete/{id}',[JoiningKitsController::class,'deleteJoiningKit'])->name('delete.joining-kit');
        Route::get('pin/history',[JoiningKitsController::class,'pinHistory'])->name('admin.pin.history');

        //Generate Pin
        Route::get('joining/pins',[JoiningKitsController::class,'joiningPins'])->name('admin.joining.pins');
        Route::post('joining/pins/generate',[JoiningKitsController::class,'generatePins'])->name('generate.pins');
        Route::match(['get','post'],'pins/status',[JoiningKitsController::class,'pinStatus'])->name('joining.pin.status');

        //Payout Report
        Route::get('payout/report',[PayoutControllerAlias::class,'index'])->name('admin.payout.report');
        Route::post('generate/payout',['as'=>'admin.generate.payout','uses'=>'PayoutController@generatePayout']);

        Route::match(['get','post'],'payout/details',[PayoutControllerAlias::class,'payoutDetails'])->name('admin.payout.details');
        Route::get('payout/details/set/paid/{id}',[PayoutControllerAlias::class,'setPayoutAsPaid'])->name('admin.payout.setpaid');
        Route::get('payout/details/set/unpaid/{id}',[PayoutControllerAlias::class,'setPayoutAsUnPaid'])->name('admin.payout.setunpaid');
        //Catagory
        Route::get('category',[CategoryController::class,'index'])->name('admin.category');
        Route::post('category',[CategoryController::class,'store'])->name('admin.store.category');
        Route::get('category/{id}',[CategoryController::class,'destroy'])->name('admin.delete.category');

        //Product
        Route::get('product',[ProductController::class,'index'])->name('admin.product');
        Route::post('product',[ProductController::class,'store'])->name('admin.store.product');
        Route::get('product-list',[ProductController::class,'list'])->name('admin.list.product');
        Route::get('subcategory/{id}',[ProductController::class,'get_subcategory'])->name('admin.get.subcategory');
        Route::get('product/delete/{id}',[ProductController::class,'destroy'])->name('admin.product.delete');
        Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
        Route::post('productupdate/update',[ProductController::class,'update'])->name('admin.product.update');
        Route::get('product_image/delete/{id}',[ProductController::class,'destroyimage'])->name('admin.delete_product_image');
        Route::get('deletedproduct',[ProductController::class,'Deleted_product_list'])->name('admin.deleted.product');

        //Orders
        Route::get('order',[OrderController::class,'index'])->name('admin.orders');

        Route::match(['get','post'],'pancard/report',[PancardController::class,'index'])->name('pancard.report');
        Route::match(['get','post'],'transfer/pins',[AdminPinController::class,'transferPin'])->name('admin.transfer.pins');

        Route::match(['get','post'],'pending/pins',[AdminPinController::class,'pendingPins'])->name('admin.pending.pins');

        Route::match(['get','post'],'user/profiles',[UsersController::class,'editUser'])->name('admin.edit.user');
        Route::get('user/franchise/{user_id}/{type}',[UsersController::class,'makeFranchiseUser'])->name('admin.franchise.user');

        Route::post('profile/update',[UsersController::class,'profileUpdate'])->name('admin.profile.update');
        Route::match(['get','post'],'welcome/letters',[WelcomeLetterController::class,'index'])->name('admin.welcome.letter');

        //Member View
        Route::get('member/view/all',[MemberViewController::class,'index'])->name('admin.member-view-all');

        //Users
        Route::get('users/{q?}',[UsersController::class,'index'])->name('admin.users');

        Route::get('kyc-details',[UsersController::class,'editKyc'])->name('admin.edit.kyc');
        Route::post('kyc-details/update',[UsersController::class,'updateKycDetails'])->name('admin.update.kyc');
        
        Route::get('user/{id}/kyc', [UsersController::class, 'getUserKyc'])->name('admin.user.kyc');
        Route::post('kyc/status', [UsersController::class, 'updateKycStatus'])->name('admin.kyc.status');

        Route::match(['get','post'],'settings',[UsersController::class,'adminCharges'])->name('admin.charges');

        Route::get('logout',[AuthControllerAlias::class,'logout'])->name('admin.logout');

        Route::match(['get','post'],'website/settings',[SettingsController::class,'index'])->name('website.settings');

        Route::match(['get','post'],'change/password',[AuthControllerAlias::class,'changePassword'])->name('change.password');

        Route::get('user/paid/{user_id}',[UsersController::class,'setUserToPaid'])->name('set-user-to-paid');

        Route::get('delete/{some_code}',[SettingsController::class,'deleteRecords'])->name('delete-records');

        /**categories controller */
        // Route::get('category/list',[CategoryController::class,'listCategory'])->name('category_admin');

        Route::get('rewards',[RewardsController::class,'index'])->name('rewards.index');
        Route::post('rewards/save',[RewardsController::class,'save'])->name('rewards.save');
        Route::get('rewards/delete/{id}',[RewardsController::class,'delete'])->name('rewards.delete');

        Route::match(['get','post'], 'sale-entries', [AdminSaleEntryController::class, 'index'])->name('admin.sale.entries');
        Route::resource('roles', RolesController::class);

        Route::get('courses',[CoursesController::class,'index'])->name('admin.courses');
        Route::post('courses/save',[CoursesController::class,'save'])->name('admin.courses.save');
        Route::delete('courses/{id}', [CoursesController::class,'delete'])->name('admin.courses.delete');
        Route::get('roles/{id}/delete',[RolesController::class,'deleteRole'])->name('roles.delete');
        // Autopool
        Route::resource('auto-pool',AutopoolController::class);
        // userPayouts
        Route::get('all/payouts',[UserPayoutController::class,'allPayouts'])->name('admin.all.payouts');
        Route::get('requested/payouts',[UserPayoutController::class,'requestedPayouts'])->name('admin.requested.payouts');
        Route::get('pay/{id}/view',[UserPayoutController::class,'payPayoutsView'])->name('admin.pay.view');
        Route::post('pay/{id}/payouts',[UserPayoutController::class,'payPayouts'])->name('admin.pay.payouts');
        Route::get('reject/{id}/payouts',[UserPayoutController::class,'rejectPayout'])->name('admin.reject.payout');

        // Loan Master Routes
        Route::resource('loan-types', \App\Http\Controllers\Admin\LoanTypeController::class)->names('admin.loan_types');
        
        // User Loan Requests
        Route::get('user-loans', [\App\Http\Controllers\Admin\UserLoanController::class, 'index'])->name('admin.user_loans.index');
        Route::post('user-loans/{id}/approve', [\App\Http\Controllers\Admin\UserLoanController::class, 'approve'])->name('admin.user_loans.approve');
        Route::post('user-loans/{id}/reject', [\App\Http\Controllers\Admin\UserLoanController::class, 'reject'])->name('admin.user_loans.reject');

        // EMI Routes (Admin)
        Route::get('emis', [AdminEmiController::class, 'index'])->name('admin.emis.index');
        Route::get('user/{id}/emis', [AdminEmiController::class, 'userEmis'])->name('admin.user.emis');
        Route::post('emi/verify', [AdminEmiController::class, 'verify'])->name('admin.emi.verify');
        Route::post('emi/reject', [AdminEmiController::class, 'reject'])->name('admin.emi.reject');

        // Level Income CRUD
        Route::resource('level-income', LevelIncomeController::class);

        // Referral Settings
        Route::resource('referral-settings', \App\Http\Controllers\Admin\ReferralSettingController::class)->names('admin.referral-settings');

        // Announcements
        Route::get('/announcements',[MemberFeaturesController::class,'announcements'])->name('announcements.index');
        Route::match(['get','post'],'/announcements/create',[MemberFeaturesController::class,'announcementCreate'])->name('announcements.create');
        Route::delete('announcement/{id}/destroy', [MemberFeaturesController::class,'announcementDestroy'])->name('announcements.destroy');

        // Selection Products
        Route::get('selection-products', [AdminSelectionProductController::class, 'index'])->name('admin.selection_products.index');
        Route::post('selection-products', [AdminSelectionProductController::class, 'store'])->name('admin.selection_products.store');
        Route::get('selection-products/delete/{id}', [AdminSelectionProductController::class, 'destroy'])->name('admin.selection_products.delete');
        Route::get('selection-products/report', [AdminSelectionProductController::class, 'report'])->name('admin.selection_products.report');

        // RD Master
        Route::resource('rds', \App\Http\Controllers\Admin\RdMasterController::class)->names('admin.rds');

        // User RDs
        Route::get('user-rds', [\App\Http\Controllers\Admin\UserRdController::class, 'index'])->name('admin.user_rds.index');
        Route::post('user-rds/{id}/review', [\App\Http\Controllers\Admin\UserRdController::class, 'review'])->name('admin.user_rds.review');

    });
    Route::get('memberids',[UsersController::class,'searchMembers'])->name('search-members');
});

/* Route::group(['prefix' => 'member'], function (){

    Route::get('login',[AuthController::class,'loginForm'])->name('login');
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::get('register',[AuthController::class,'registerForm'])->name('register');
    Route::post('register',[AuthController::class,'register'])->name('register');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('register/details',[AuthController::class,'registerDetails'])->name('register.details');
    Route::match(['get','post'],'forget/password',[AuthController::class,'forgetPassword'])
        ->name('forget.password');

    Route::group(['middleware'=>'member_auth'], function(){
        //Dashboard
        Route::get('dashboard',[DashboardController::class,'index'])->name('member.dashboard');

        Route::get('my-receipt',[RecordController::class,'myReceipt'])->name('receipt');
        Route::get('my-invoice',[RecordController::class,'myInvoice'])->name('invoice');
        Route::get('my-card',[RecordController::class,'idCard'])->name('id-card');

        //Account Management
        Route::get('profile',[AccountController::class,'profile'])->name('account.profile');
        Route::get('profile/edit',[AccountController::class,'editProfile'])->name('account.profile-edit');
        Route::post('profile/save',[AccountController::class,'saveProfile'])->name('account.save-profile');

        Route::post('update/profile/image',[AccountController::class,'updateProfileImage'])->name('member.profile.image.update');

        Route::get('kyc',[AccountController::class,'kycDetails'])->name('account.kyc-details');
        Route::post('kyc/update',[AccountController::class,'updateKycDocuments'])->name('update.kyc-documents');
        Route::get('bank-details',[AccountController::class,'editBankDetails'])->name('edit-bank-details');
        Route::post('bank-details/save',[AccountController::class,'saveBankDetails'])->name('account.save-bank-details');
        Route::get('change-password',[AccountController::class,'changePassword'])->name('account.change-password');
        Route::post('password/update',[AccountController::class,'updatePassword'])->name('account.update-password');

        Route::get('directs',[BinaryTreeController::class,'myDirects'])->name('my-directs');
        Route::get('downline',[BinaryTreeController::class,'downline'])->name('my-downline');

        //Pin Management
        Route::get('joining-pins',[PinController::class,'joiningPins'])->name('joining-pins');
        Route::get('pins/transfer',[PinController::class,'transferPins'])->name('transfer-pins');
        Route::post('pins/transfer',[PinController::class,'transferPinsNow'])->name('transfer-pins-now');
        Route::get('pins/history',[PinController::class,'pinsHistory'])->name('member.pins.history');
        Route::get('self/upgrade',[PinController::class,'selfUpgradeView'])->name('member.self-upgrade.view');
        Route::post('self/upgrade',[PinController::class,'selfUpgrade'])->name('member.self-upgrade');

        Route::get('tree/{number}',[BinaryTreeController::class,'index'])->name('member.tree');
        //AjaxRoute
        Route::get('binary/tree/{number}',[BinaryTreeController::class,'tree'])->name('member.tree.view');

        Route::get('payout-details',[PayoutController::class,'index'])->name('member.payout.details')->middleware('topup_validate');

        Route::match(['get','post'], 'sale-entries', [SaleEntryController::class, 'index'])->name('member.sale.entries');

        Route::get('purchase',[SaleEntryController::class,'myPurchases'])->name('member.my-purchases');

        //Rewards
        Route::get('my-rewards',[RewardsControllerAlias::class,'index'])->name('member.rewards');

        Route::get('top-up',[DashboardController::class,'topupPage'])->name('topup');
        Route::match(['get','post'],'user/topup',[DashboardController::class,'topupNow'])->name('member.topup.now');

        Route::match(['get','post'],'joining/packages',[PinController::class,'joiningPackages'])->name('member.joining-packages');
        Route::get('role/users',[BinaryTreeController::class,'usersByRole'])->name('role.users');
        Route::get('add/member',[BinaryTreeController::class,'addMember'])->name('add.member');
        Route::post('store/member',[BinaryTreeController::class,'storeMember'])->name('store.member');

        Route::match(['get','post'],'replace/tree',[BinaryTreeController::class,'replaceTree'])->name('member.tree.replace');
        // userPayouts
        Route::get('user/payouts',[UserPayoutController::class,'index'])->name('member.user.payouts');
        Route::get('request/{id}/payouts',[UserPayoutController::class,'payoutRequest'])->name('member.request.payout');
        Route::post('user/payouts/bulk-transfer',[WalletTransactionController::class,'bulkTransferToWallet'])->name('member.payout.bulk-transfer');

        Route::get('wallet',[WalletTransactionController::class,'walletIndex'])->name('member.wallet');
        // User Transaction
        Route::get('transfer/to/wallet', [WalletTransactionController::class, 'transferToWallet'])->name('income.transfer.to.wallet');
        Route::post('wallet/transaction', [WalletTransactionController::class, 'walletTransaction'])->name('member.wallet.transaction');
        Route::match(['get','post'],'wallet/withdrawal',[TransactionsController::class,'withdrawlCreate'])->name('wallet.withdrawl');
        Route::match(['get','post'],'wallet/pin',[TransactionsController::class,'setTransactionPin'])->name('wallet.pin');

        // EMI Routes (Member)
        Route::get('emis', [EmiController::class, 'index'])->name('member.emis.index');
        Route::post('emi/pay', [EmiController::class, 'pay'])->name('member.emi.pay');

        // My Product Selection
        Route::get('my-product', [MemberSelectionProductController::class, 'index'])->name('member.my_product');
        Route::post('select-product', [MemberSelectionProductController::class, 'select'])->name('member.select_product');
    });


    //Ajax Routes
    Route::get('sponsor/validate',[AjaxController::class,'validateSponsor'])->name('sponsor.details');
    Route::get('pins/available',[AjaxController::class,'availablePins'])->name('available.pins');
    Route::get('joining-pins/available',[AjaxController::class,'joiningPins'])->name('available.joining-pins');
    Route::get('send/otp',[AjaxController::class,'sendOtp'])->name('send.otp');

}); */

Route::group(['prefix'=>'student'],function(){
    Route::group(['middleware'=>'member_auth'], function(){
        // Student Routes
        Route::get('courses',[CoursesController::class,'viewCourses'])->name('student.courses');
        Route::get('my-courses',[CoursesController::class,'myCourses'])->name('student.my-courses');
    });

    Route::get('student/registration',[StudentRegistrationController::class,'index'])->name('student.registration');
    Route::post('student/register', [StudentRegistrationController::class, 'register'])->name('register.student');
});


//Route::get('/',[WebsiteController::class,'index'])->name('web.home');
//Route::get('/about-us',[WebsiteController::class,'aboutus'])->name('web.aboutus');
//Route::get('/business',[WebsiteController::class,'business'])->name('web.business');
//Route::get('/products',[WebsiteController::class,'products'])->name('web.products');
//Route::get('/contact-us',[WebsiteController::class,'contactUs'])->name('web.contact');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy.policy');

Route::get('/delete-account', function () {
    return view('frontend.delete-account');
})->name('delete.account');
