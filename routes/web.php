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
// Route::group(['middleware' => ['web', 'cors']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/hostelrooms', function () {
        return view('guest.reservation');
    });

    Route::get('/login', function () {
        return view('guest.login');
    })->name('login');

    Route::get('/register', function () {
        return view('guest.register');
    })->name('register');
    // Route::post('signin', 'AuthController@signin');
    Route::post('signin', 'AuthController@signin');

    Route::get('signout', 'AuthController@signout');

    Route::get('/csrf-token', function() {
        return response()->json(['csrf_token' => csrf_token()]);
    });
    // Route::get('/register', function () {
    //     return view('dorm.register');
    // });

    Route::get('/visitor', function () {
        return view('guest.visitor');
    });

Route::middleware(['adminbranch:Dormitory'])->group(function () {

    Route::prefix('admin/dorm')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dorm.dashboard');
        });

        Route::get('/residents', function () {
            return view('admin.dorm.residents');
        });

        Route::get('/registereduser', function () {
            return view('admin.dorm.registered');
        });
        
        //incomplete
        Route::get('/rooms', function () {
            return view('admin.dorm.rooms');
        });

        //incomplete
        Route::get('/announcements', function () {
            return view('admin.dorm.announcements');
        });

        //incomplete
        Route::get('/transactions', function () {
            return view('admin.dorm.transactions');
        });

        //incomplete
        Route::get('/violations', function () {
            return view('admin.dorm.violations');
        });

        //incomplete
        Route::get('/laundry', function () {
            return view('admin.dorm.laundry');
        });

        Route::get('/lostandfound', function () {
            return view('admin.dorm.lostandfound');
        });

        Route::get('/user/profile/{id}', function () {
            return view('admin.dorm.residentprofile');
        });

        Route::get('/beds', function () {
            return view('admin.dorm.beds');
        });

        Route::get('/maintenance', function () {
            return view('admin.dorm.maintenance');
        });
    });
});
    
Route::middleware(['adminbranch:Hostel'])->group(function () {
    Route::prefix('admin/hostel')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.hostel.dashboard');
        });

        Route::get('/residents', function () {
            return view('admin.hostel.residents');
        });

        Route::get('/newresident', function () {
            return view('admin.hostel.newresident');
        });
        
        //incomplete
        Route::get('/rooms', function () {
            return view('admin.hostel.rooms');
        });

        //incomplete
        Route::get('/announcements', function () {
            return view('admin.hostel.announcements');
        });

        //incomplete
        Route::get('/transactions', function () {
            return view('admin.hostel.transactions');
        });

        //incomplete
        Route::get('/violations', function () {
            return view('admin.hostel.violations');
        });

        //incomplete
        Route::get('/laundry', function () {
            return view('admin.hostel.laundry');
        });

        Route::get('/lostandfound', function () {
            return view('admin.hostel.lostandfound');
        });

        Route::get('/user/profile/{id}', function () {
            return view('admin.hostel.residentprofile');
        });

        Route::get('/beds', function () {
            return view('admin.hostel.beds');
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

            Route::get('/maintenance', function () {
                return view('resident.maintenance');
            });

            Route::get('/billingandpayment', function () {
                return view('resident.billing');
            });
        });
    });

// });
