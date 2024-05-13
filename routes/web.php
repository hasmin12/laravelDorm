<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleSocialiteController;
// use App\Models\Resident; 
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
    use Illuminate\Support\Facades\Auth;

// Example route that requires authentication
    Route::get('/getAuthUser', function () {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Return the authenticated user as JSON response
            return response()->json($user);
        } else {
            // User is not authenticated, return an error response
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    });

    Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
    Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);
    Route::get('callback/googleMobile', [GoogleSocialiteController::class, 'handleCallbackMobile']);

    
    
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');


    Route::get('/hostelrooms', function () {
        return view('guest.reservation');
    })->name('hostelrooms');

    Route::get('/dormlogs', function () {
        return view('guest.dormlogs');
    });

    Route::get('/login', function () {
        return view('guest.login');
    })->name('login');

    Route::get('/register', function () {
        return view('guest.register');
    })->name('register');

    Route::get('/example', function () {
        return view('guest.example');
    })->name('example');
    
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
    })->name('visitor');

Route::middleware(['adminbranch:Dormitory'])->group(function () {

    Route::prefix('admin/dorm')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dorm.dashboard');
        });

        Route::get('/residents', function () {
            return view('admin.dorm.residents');
        });

        Route::get('/applicants', function () {
            return view('admin.dorm.applicants');
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

        Route::get('/newresident', function () {
            return view('admin.dorm.newresident');
        });
        
        //incomplete
        Route::get('/laundry', function () {
            return view('admin.dorm.laundry');
        });

        Route::get('/lostandfound', function () {
            return view('admin.dorm.lostandfound');
        });
        Route::get('/reservations', function () {
            return view('admin.dorm.reservations');
        });

        Route::get('/user/profile/{id}', function () {
            return view('admin.dorm.reservations');
        });

        Route::get('/beds', function () {
            return view('admin.dorm.beds');
        });

        Route::get('/maintenance', function () {
            return view('admin.dorm.maintenance');
        });

        Route::get('/logs', function () {
            return view('admin.dorm.logs');
        });

        Route::get('/reports', function () {
            return view('admin.dorm.reports');
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

            Route::get('/home', function () {
                return view('resident.home');
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

            Route::get('/payments', function () {
                return view('resident.payments');
            });
            
            Route::get('/reservations', function () {
                return view('resident.reservations');
            });

        });
    });

    Route::group(['middleware' => ['role:Technician']], function () {
        Route::prefix('technician')->group(function () {
            
            
            Route::get('/maintenance', function () {
                return view('technician.maintenance');
            });
        });
    });

// });
