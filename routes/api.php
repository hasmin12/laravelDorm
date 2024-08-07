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

Route::get('/getHostelRoomDetails/{id}', 'GuestController@getHostelRoomDetails');

Route::post('/createReservation', 'GuestController@createReservation');
Route::post('/createRegistration', 'GuestController@createRegistration');
Route::get('/getReservations', 'GuestController@getReservations');
Route::get('/getReservations', 'AdminController@getReservations');
Route::get('/updateReservationStatus', 'AdminController@updateReservationStatus');
Route::get('/checkoutReservation', 'AdminController@checkoutReservation');
Route::get('/getReviews/{id}', 'GuestController@getReviews');
Route::get('/getLogs/{id}', 'AdminController@getLogs');


Route::post('/createComplaint', 'ResidentController@createComplaint');
Route::post('/sendLogs', 'ResidentController@sendLogs');
Route::post('/updateLogs', 'ResidentController@updateLogs');
Route::get('/myLogs', 'ResidentController@myLogs');
Route::get('/myReservations', 'ResidentController@myReservations');
Route::post('createLaundrySchedule', 'ResidentController@createLaundrySchedule');
Route::get('/getLaundry', 'AdminController@getLaundry');
Route::get('/sendSleep', 'ResidentController@sendSleep');
Route::get('/getComplaints', 'AdminController@getComplaints');
Route::get('/getAllLogs', 'AdminController@getAllLogs');
Route::get('/getAllSleepLogs', 'AdminController@getAllSleepLogs');
Route::get('/getRooms', 'AdminController@getRooms');
Route::get('/getResidents', 'AdminController@getResidents');
Route::get('/getApplicants', 'AdminController@getApplicants');
Route::get('/getLostitems', 'AdminController@getLostitems');
    Route::post('/addComment', 'ResidentController@addComment');
    Route::get('/getComments', 'AuthController@getComments');


Route::get('/getAnnouncements', 'AuthController@getAnnouncements');

Route::group(['middleware' => ['auth:sanctum']], function(){
    
    Route::get('/getResidentDataByType', 'ChartController@getResidentDataByType');
    Route::get('/countResidentsByType', 'ChartController@countResidentsByType');
    Route::get('/getDormPaymentChartData', 'ChartController@getDormPaymentChartData');


    
    Route::get('/getDashboardData', 'AdminController@getDashboardData');
    Route::get('/getInactive', 'AdminController@getInactiveResidents');
    Route::get('/getResident/{id}', 'AdminController@getResident');
    Route::get('/getSleepLogs/{id}', 'AdminController@getSleepLogs');
    Route::get('/admin/logs', 'AdminController@getResidentLogs');
    Route::get('/getDormPayments', 'AdminController@getDormPayments');
    

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

    

   
    
    
    Route::get('/notifyResidents', 'AdminController@notifyResidents');
    Route::get('/getBeds/{id}', 'AdminController@getBeds');
    Route::get('/fetchBed/{id}', 'AdminController@fetchBed');
    Route::post('updateBed/{id}', 'AdminController@updateBed');
    Route::get('/getViolations', 'AdminController@getViolations');
    Route::post('/createViolation', 'AdminController@createViolation');

    Route::get('/getVisitors', 'AdminController@getVisitors');

    

    Route::get('/getAnnouncement/{id}', 'AdminController@getAnnouncement');
    Route::post('/createAnnouncement', 'AdminController@createAnnouncement');
    Route::post('updateAnnouncement/{id}', 'AdminController@updateAnnouncement');
    Route::post('/update_announcement/{id}', 'AdminController@lockComments');
    Route::delete('deleteAnnouncement/{id}', 'AdminController@deleteAnnouncement');

    Route::get('/getRoom/{id}', 'AdminController@getRoom');
    Route::post('/createRoom', 'AdminController@createRoom');
    Route::post('updateRoom/{id}', 'AdminController@updateRoom');
    Route::delete('deleteRoom/{id}', 'AdminController@deleteRoom');

    Route::get('/getLostitem/{id}', 'AdminController@getLostitem');
    Route::post('/lostitem', 'AdminController@createLostitem');
    Route::post('updateLostitem/{id}', 'AdminController@updateLostitem');
    Route::delete('deleteLostitem/{id}', 'AdminController@deleteLostitem');

    
    Route::post('/laundryschedule', 'AdminController@createLaundryschedule');

    // Route::get('/resident/getAnnouncements', 'ResidentController@getAnnouncements');
    Route::post('/updateEquipment', 'ResidentController@updateEquipment');


    Route::post('/resident/createMaintenance', 'ResidentController@createMaintenance');
    Route::get('/getMaintenances', 'ResidentController@getMaintenances');
    Route::get('/admin/getMaintenances', 'AdminController@getMaintenances');
    Route::post('/approveMaintenance/{id}', 'ResidentController@approveMaintenance');
 



    Route::get('/getTechnicians', 'AdminController@getTechnicians');

    // Get maintenance changes
    Route::get('/getMaintenanceChanges','AdminController@getMaintenanceChanges');

    // Create maintenance request
    Route::post('/createMaintenance', 'AdminController@createMaintenance');

    // Assign technician to maintenance request
    Route::post('/assignTechnician', 'AdminController@assignTechnician');
    Route::get('/getInactive', 'AdminController@getInactive');

    

    Route::get('/api/getViolations', 'AdminController@getViolations');
    Route::post('/api/addViolationuser', 'AdminController@addViolationuser');
    Route::get('/notifyViolations', 'AdminController@notifyResidents');
    Route::get('/dischargeResident/{id}', 'AdminController@dischargeResident');
    Route::get('/ReActivateResident/{id}', 'AdminController@ReActivateResident');
    Route::get('/notificationRead', 'AuthController@notificationRead');

    


    Route::post('/acceptMaintenance', 'TechnicianController@acceptMaintenance');
    Route::post('/resident/acceptMaintenance', 'ResidentController@acceptMaintenance');
    Route::get('/getMaintenanceStatus', 'TechnicianController@getMaintenanceStatus');
    
    Route::post('/addMaintenanceStatus', 'TechnicianController@addMaintenanceStatus');
    Route::get('/technician/getMaintenance', 'TechnicianController@getMaintenance');

    Route::get('/getNotifications', 'AuthController@getNotifications');

    

    Route::get('/sendRating', 'ResidentController@sendRating');

    Route::get('/cancelReservation/{id}', 'ResidentController@cancelReservation');


    Route::get('/getLogs', 'AdminController@getLogs');
   
    Route::get('/getMaintenanceList', 'AuthController@getMaintenanceList');



//charts
Route::get('/residentChart', 'ChartController@residentChart');
Route::get('/residentTypeChart', 'ChartController@residentTypeChart');


//reports
Route::get('/residentsReport', 'ReportController@residentsReport');
Route::get('/generateResidentsReport', 'ReportController@generateResidentsReport');

Route::get('/maintenanceReport', 'ReportController@maintenanceReport');
Route::get('/generateMaintenanceReport', 'ReportController@generateMaintenanceReport');

Route::get('/visitorsReport', 'ReportController@visitorsReport');
Route::get('/generateVisitorsReport', 'ReportController@generateVisitorsReport');

Route::get('/laundryReport', 'ReportController@laundryReport');
Route::get('/generateLaundryReport', 'ReportController@generateLaundryReport');

    
});
Route::post('/googleSigninMobile', 'GoogleSocialiteController@googleSigninMobile');

Route::post('signin', 'AuthController@signin');
Route::post('signout', 'AuthController@signout');

