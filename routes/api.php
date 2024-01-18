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



Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/getResidents', 'AdminController@getResidents');
    Route::get('/getRooms', 'AdminController@getRooms');
    Route::get('/getLostitems', 'AdminController@getLostitems');
    Route::get('/notifyResidents', 'AdminController@notifyResidents');
    Route::get('/getBeds/{id}', 'AdminController@getBeds');

    Route::get('/getAnnouncements', 'AuthController@getAnnouncements');
    Route::get('/getLaundry', 'AuthController@getLaundry');
    // Route::get('/resident/getLaundry', 'ResidentController@getLaundry');
    // Route::get('/resident/getAnnouncements', 'ResidentController@getAnnouncements');

    
});