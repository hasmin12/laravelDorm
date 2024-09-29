<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobileController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/maintenanceusers', [UserController::class, 'MaintenanceUsers'])->name('maintenanceusers');

Route::post('/signin', [MobileController::class, 'signin'])->name('mobile.signin');

Route::get('/announcements', [MobileController::class, 'announcements'])->name('mobile.announcements');
Route::get('/mymaintenance/{id}', [MobileController::class, 'mymaintenance'])->name('mobile.mymaintenance');
Route::post('/requestmaintenance/{id}', [MobileController::class, 'requestmaintenance'])->name('mobile.requestmaintenance');

Route::get('/lostandfound', [MobileController::class, 'lostandfound'])->name('mobile.lostandfound');
Route::get('/laundry', [MobileController::class, 'laundry'])->name('mobile.laundry');
Route::post('/schedulelaundry/{id}', [MobileController::class, 'schedulelaundry'])->name('mobile.schedulelaundry');

Route::get('/mypayments/{id}', [MobileController::class, 'mypayments'])->name('mobile.mypayments');
Route::post('/sendpayment/{id}', [MobileController::class, 'sendpayment'])->name('mobile.sendpayment');

Route::get('/leaveRequest/{id}', [MobileController::class, 'leaveRequest'])->name('mobile.leaveRequest');
Route::post('/returned/{id}', [MobileController::class, 'returned'])->name('mobile.returned');
Route::post('/requestleave/{id}', [MobileController::class, 'requestleave'])->name('mobile.requestleave');

Route::get('/mySleep/{id}', [MobileController::class, 'mySleep'])->name('mobile.mySleep');
Route::get('/sendSleep/{id}', [MobileController::class, 'sendSleep'])->name('mobile.sendSleep');






