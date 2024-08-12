<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebBookingController;
use App\Http\Controllers\WebBuildingController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\WeeklyBookingController;
use App\Http\Controllers\LoginWithGoogleController;

Route::get('/home', [HomeController::class, "index"]);

Route::get('/blog', [HomeController::class, "blog"]);
Route::get('/blog/{id}', [HomeController::class, "detailBlog"]);
Route::post('/blog', [HomeController::class, "searchBlog"]);
Route::get('/building', [WebBuildingController::class, "index"]);
Route::get('/building/{id}', [WebBuildingController::class, "detail"]);
Route::post('/search-building', [WebBuildingController::class, "searchBuilding"]);

Route::get('/privacy-policy', [HomeController::class, "showPrivacyPolicy"]);
Route::get('/return-refund-policy', [HomeController::class, "showReturnRefundPolicy"]);
Route::get('/terms-conditions', [HomeController::class, "showTermsConditions"]);

Route::get('/booking/{id}', [WebBookingController::class, "detail"])->middleware('auth');

Route::post('/booking-filter', [WebBookingController::class, "filter"])->middleware('auth');

Route::get('/checkout/{id}', [WebBookingController::class, "checkout"])->middleware('auth');
Route::get('/midtrans-payment/{id}', [WebBookingController::class, "midtransPayment"])->middleware('auth');
Route::get('/success-booking/{id}', [WebBookingController::class, "success"])->middleware('auth');
Route::get('/receipt/{id}', [WebBookingController::class, "receipt"])->middleware('auth');
Route::post('/reserve', [WebBookingController::class, "reserve"])->middleware('auth');
Route::post('/delete-reserve', [WebBookingController::class, "deleteReserve"])->middleware('auth');
Route::post('/delete-booking', [WebBookingController::class, "deleteBooking"])->middleware('auth');
Route::post('/valid-time-checking', [WebBookingController::class, "checkValidTime"])->middleware('auth');

Route::get('/dashboard', [WebUserController::class, "index"])->middleware('auth');
Route::get('/profile', [WebUserController::class, "profile"])->middleware('auth');
Route::get('/password', [WebUserController::class, "password"])->middleware('auth');

Route::post('/payment', [WebBookingController::class, "payment"])->middleware('auth');
Route::put('/profile', [WebUserController::class, "updateProfile"])->middleware('auth');
Route::put('/password', [WebUserController::class, "updatePassword"])->middleware('auth');


Route::get('/login', [AuthController::class, "index"])->name('login')->middleware('guest');
Route::post('/login/do', [AuthController::class, "doLogin"]);

Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);

Route::get('/', [HomeController::class, "index"]);
Route::get('/logout', [AuthController::class, "logout"])->middleware('auth');

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, "index"]);

        Route::get('/company', [CompanyController::class, "index"]);
        Route::get('/social-media', [CompanyController::class, "socialMedia"]);
        Route::get('/web/banner', [CompanyController::class, "banner"]);
        Route::resource('/web/benefit', BenefitController::class);
        Route::resource('/web/blog-category', BlogCategoryController::class);
        Route::resource('/web/blog', BlogController::class);
        Route::resource('/web/question', QuestionController::class);

        Route::put('/company/{id}', [CompanyController::class, "update"]);
        Route::put('/social-media/{id}', [CompanyController::class, "updateSocialMedia"]);
        Route::put('/web/banner/{id}', [CompanyController::class, "updateBanner"]);

        Route::resource('/building/type', TypeController::class);
        Route::resource('/building', BuildingController::class);
        Route::resource('/court', CourtController::class);
        Route::get('/schedule', [ScheduleController::class, "index"]);
        Route::get('/schedule/create', [ScheduleController::class, "create"]);
        Route::post('/schedule', [ScheduleController::class, "store"]);
        Route::resource('/receipt', ReceiptController::class);
        Route::resource('/payment', PaymentController::class);
        Route::post('/receipt-date-change', [ReceiptController::class, "changeDate"]);

        Route::get('/weekly-booking', [WeeklyBookingController::class, "index"]);
        Route::get('/weekly-booking/create', [WeeklyBookingController::class, "create"]);
        Route::post('/weekly-booking', [WeeklyBookingController::class, "store"]);
        Route::post('/weekly-booking/receipt', [WeeklyBookingController::class, "addReceipt"]);

        Route::delete('/weekly-booking/{id}', [WeeklyBookingController::class, "destroy"]);

        Route::resource('/user', UserController::class)->middleware('checkRole:superadmin,admin');


        Route::get('/legal', [LegalController::class, "showLegal"]);
        Route::put('/legal', [LegalController::class, "update"]);

    }
);
