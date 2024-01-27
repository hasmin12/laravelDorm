<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getHostelrooms', 'GuestController@getHostelrooms');
Route::get('/visitor/getResidents', 'GuestController@getResidents');
Route::post('/visitor', 'GuestController@addVisitor');


Route::post('/createReservation', 'GuestController@createReservation');
Route::post('/createRegistration', 'GuestController@createRegistration');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/getDashboardData', 'AdminController@getDashboardData');


    Route::get('/getResidents', 'AdminController@getResidents');
    Route::get('/getRegisteredusers', 'AdminController@getRegisteredusers');
    Route::post('/addRegistereduser', 'AdminController@addRegistereduser');

    
    
    Route::get('/notifyResidents', 'AdminController@notifyResidents');
    Route::get('/getBeds/{id}', 'AdminController@getBeds');

    

    Route::get('/getAnnouncements', 'AuthController@getAnnouncements');
    Route::get('/getAnnouncement/{id}', 'AdminController@getAnnouncement');
    Route::post('/announcement', 'AdminController@createAnnouncement');
    Route::post('updateAnnouncement/{id}', 'AdminController@updateAnnouncement');
    Route::delete('deleteAnnouncement/{id}', 'AdminController@deleteAnnouncement');

    Route::get('/getRooms', 'AdminController@getRooms');
    Route::get('/getRoom/{id}', 'AdminController@getRoom');
    Route::post('/createRoom', 'AdminController@createRoom');
    Route::post('updateRoom/{id}', 'AdminController@updateRoom');
    Route::delete('deleteRoom/{id}', 'AdminController@deleteRoom');

    Route::get('/getLostitems', 'AdminController@getLostitems');
    Route::get('/getLostitem/{id}', 'AdminController@getLostitem');
    Route::post('/lostitem', 'AdminController@createLostitem');
    Route::post('updateLostitem/{id}', 'AdminController@updateLostitem');
    Route::delete('deleteLostitem/{id}', 'AdminController@deleteLostitem');

    
    Route::get('/getLaundry', 'AdminController@getLaundry');
    Route::post('/laundryschedule', 'AdminController@createLaundryschedule');

    // Route::get('/resident/getLaundry', 'ResidentController@getLaundry');
    // Route::get('/resident/getAnnouncements', 'ResidentController@getAnnouncements');

    Route::post('/createRepair', 'ResidentController@createRepair');
    Route::get('/getRepairs', 'ResidentController@getRepairs');
    Route::get('/admin/getRepairs', 'AdminController@getRepairs');


   


    
});

Route::post('signin', 'AuthController@signin');
Route::post('signout', 'AuthController@signout');

