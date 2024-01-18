<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['web', 'cors']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', function () {
        return view('dorm.login');
    })->name('login');
    // Route::post('signin', 'AuthController@signin');
    Route::post('signin', 'AuthController@signin');

    Route::post('signout', 'AuthController@signout');


    Route::get('/register', function () {
        return view('dorm.register');
    });

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            });

            Route::get('/residents', function () {
                return view('admin.residents');
            });
            
            //incomplete
            Route::get('/rooms', function () {
                return view('admin.rooms');
            });

            //incomplete
            Route::get('/announcements', function () {
                return view('admin.announcements');
            });

            //incomplete
            Route::get('/transactions', function () {
                return view('admin.announcements');
            });

            //incomplete
            Route::get('/violations', function () {
                return view('admin.announcements');
            });

            //incomplete
            Route::get('/laundry', function () {
                return view('admin.laundry');
            });

            Route::get('/lostandfound', function () {
                return view('admin.lostandfound');
            });

            Route::get('/user/profile/{id}', function () {
                return view('admin.residentprofile');
            });

            Route::get('/beds', function () {
                return view('admin.beds');
            });
        });

    });

    Route::group(['middleware' => ['role:Resident']], function () {
        Route::prefix('resident')->group(function () {
            Route::get('/profile', function () {
                return view('resident.profile');
            });

            Route::get('/announcements', function () {
                return view('resident.announcements');
            });

            Route::get('/laundry', function () {
                return view('resident.laundry');
            });

            Route::get('/lostandfound', function () {
                return view('resident.lostandfound');
            });

            Route::get('/billingandpayment', function () {
                return view('resident.billing');
            });
        });
    });

});
