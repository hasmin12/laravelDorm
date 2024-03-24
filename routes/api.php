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

Route::post('/registerDorm', 'GuestController@addVisitor');



Route::post('/createReservation', 'GuestController@createReservation');
Route::post('/createRegistration', 'GuestController@createRegistration');
Route::get('/getReservations', 'GuestController@getReservations');
Route::post('/getHostelrooms', 'GuestController@getHostelrooms');

Route::get('/getReviews/{id}', 'GuestController@getReviews');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/getDashboardData', 'AdminController@getDashboardData');
    Route::get('/getResidents', 'AdminController@getResidents');
    Route::get('/getResident/{id}', 'AdminController@getResident');
    Route::get('/getRegisteredusers', 'AdminController@getRegisteredusers');
    Route::post('/addRegistereduser', 'AdminController@addRegistereduser');
    Route::post('/updateResident/{id}', 'AdminController@updateResident');
    Route::delete('archiveResident/{id}', 'AdminController@archiveResident');
    Route::get('getPaymentHistory', 'AdminController@getPaymentHistory');
    Route::get('myPaymentHistory', 'ResidentController@myPaymentHistory');
    Route::post('/uploadReceipt', 'ResidentController@uploadReceipt');
    Route::post('createPayment', 'ResidentController@createPayment');
    Route::get('/generatePdf', 'ChartController@generatePdf');
    Route::get('/approveApplicant/{id}', 'AdminController@approveApplicant');
    Route::post('/assignResident', 'AdminController@assignResident');
    Route::post('/passContract', 'ResidentController@passContract');
    Route::post('/createResident', 'AdminController@createResident');

    Route::post('createLaundrySchedule', 'ResidentController@createLaundrySchedule');


    
    
    Route::get('/notifyResidents', 'AdminController@notifyResidents');
    Route::get('/getBeds/{id}', 'AdminController@getBeds');
    Route::get('/getViolations', 'AdminController@getViolations');
    Route::post('/createViolation', 'AdminController@createViolation');


    

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
    Route::post('/updateEquipment', 'ResidentController@updateEquipment');


    Route::post('/createMaintenance', 'ResidentController@createMaintenance');
    Route::get('/getMaintenances', 'ResidentController@getMaintenances');
    Route::get('/admin/getMaintenances', 'AdminController@getMaintenances');
    Route::post('/approveMaintenance/{id}', 'ResidentController@approveMaintenance');

    Route::get('/api/getViolations', 'AdminController@getViolations');
    Route::post('/api/addViolationuser', 'AdminController@addViolationuser');
    Route::get('/notifyViolations', 'AdminController@notifyResidents');


    Route::post('/acceptMaintenance', 'TechnicianController@acceptMaintenance');
    Route::post('/resident/acceptMaintenance', 'ResidentController@acceptMaintenance');
    Route::get('/getMaintenanceStatus', 'TechnicianController@getMaintenanceStatus');
    
    Route::post('/addMaintenanceStatus', 'TechnicianController@addMaintenanceStatus');

    Route::get('/getNotifications', 'AuthController@getNotifications');

    
    Route::post('/createComplaint', 'ResidentController@createComplaint');
    Route::post('/sendLogs', 'ResidentController@sendLogs');
    Route::post('/updateLogs', 'ResidentController@updateLogs');
    Route::get('/myLogs', 'ResidentController@myLogs');
    Route::get('/myReservations', 'ResidentController@myReservations');
    Route::get('/cancelReservation/{id}', 'ResidentController@cancelReservation');

    Route::get('/sendSleep', 'ResidentController@sendSleep');

    Route::get('/getLogs', 'AdminController@getLogs');
   
    Route::get('/getComplaints', 'AdminController@getComplaints');
    Route::get('/getMaintenanceList', 'AuthController@getMaintenanceList');



//charts
Route::get('/residentChart', 'ChartController@residentChart');
Route::get('/residentTypeChart', 'ChartController@residentTypeChart');

    
});

Route::post('signin', 'AuthController@signin');
Route::post('signout', 'AuthController@signout');

