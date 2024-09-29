<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DormitoryRoomController;
use App\Http\Controllers\HostelRoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});


//Landing-Pages Routes
Route::group(['prefix' => 'landing-pages'], function() {
Route::get('index',[HomeController::class, 'landing_index'])->name('landing-pages.index');
Route::get('blog',[HomeController::class, 'landing_blog'])->name('landing-pages.blog');
Route::get('blog-detail',[HomeController::class, 'landing_blog_detail'])->name('landing-pages.blog-detail');
Route::get('about',[HomeController::class, 'landing_about'])->name('landing-pages.about');
Route::get('contact',[HomeController::class, 'landing_contact'])->name('landing-pages.contact');
Route::get('ecommerce',[HomeController::class, 'landing_ecommerce'])->name('landing-pages.ecommerce');
Route::get('faq',[HomeController::class, 'landing_faq'])->name('landing-pages.faq');
Route::get('feature',[HomeController::class, 'landing_feature'])->name('landing-pages.feature');
Route::get('pricing',[HomeController::class, 'landing_pricing'])->name('landing-pages.pricing');
Route::get('saas',[HomeController::class, 'landing_saas'])->name('landing-pages.saas');
Route::get('shop',[HomeController::class, 'landing_shop'])->name('landing-pages.shop');
Route::get('shop-detail',[HomeController::class, 'landing_shop_detail'])->name('landing-pages.shop-detail');
Route::get('software',[HomeController::class, 'landing_software'])->name('landing-pages.software');
Route::get('startup',[HomeController::class, 'landing_startup'])->name('landing-pages.startup');
});

//UI Pages Routs
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::group(['prefix' => 'guest'], function() {
    Route::get('hostel', [HostelRoomController::class, 'ViewHostels'])->name('guest.hostel');
    Route::post('reserve', [HostelRoomController::class, 'reserve'])->name('guest.reserve');

});


Route::group(['middleware' => 'auth'], function () {
    // Permission Module
    Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission',PermissionController::class);
    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/laundry',[LaundryController::class, 'laundry'])->name('laundry');
    Route::get('/laundry/getLaundrySchedules', [LaundryController::class, 'getLaundrySchedules'])->name('getLaundrySchedules');
    Route::get('/getNotifications', [AuthenticatedSessionController::class, 'getNotifications'])->name('getNotifications');

    // Users Module
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/dormitorychart', [ChartController::class, 'dormitorychart'])->name('admin.dormitorychart');
        Route::get('/hostelchart', [ChartController::class, 'hostelchart'])->name('admin.hostelchart');

        Route::resource('users', UserController::class);
        Route::post('/assignBed', [DormitoryRoomController::class, 'assignBed'])->name('admin.assignBed');
        Route::get('/notify', [PaymentController::class, 'notifyResidents'])->name('admin.notifyResidents');

        Route::get('/dormitoryresidents', [UserController::class, 'DormitoryResidents'])->name('dormitoryresidents');
        Route::get('/dormitoryresidents/create', [UserController::class, 'CreateDormitoryResidents'])->name('dormitoryresidents.create');
        Route::post('/dormitoryresidents', [UserController::class, 'StoreDormitoryResidents'])->name('dormitoryresidents.store');
        Route::get('/dormitoryresidents/{id}/edit', [UserController::class, 'EditDormitoryResidents'])->name('dormitoryresidents.edit');
        Route::patch('/dormitoryresidents/{id}', [UserController::class, 'UpdateDormitoryResidents'])->name('dormitoryresidents.update');
        Route::delete('/dormitoryresidents/{id}', [UserController::class, 'DeleteDormitoryResidents'])->name('dormitoryresidents.destroy');
        Route::post('/dormitoryresidents/{id}', [UserController::class, 'deactivate'])->name('dormitoryresidents.deactivate');

        Route::get('/user-profile/application-form/{id}', [UserProfileController::class, 'showApplicationForm'])->name('userProfile.applicationForm.show');
        Route::get('/user-profile/contract/{id}', [UserProfileController::class, 'showContract'])->name('userProfile.contract.show');
        Route::get('/user-profile/cor/{id}', [UserProfileController::class, 'showCor'])->name('userProfile.cor.show');
        Route::get('/user-profile/validID/{id}', [UserProfileController::class, 'showValidId'])->name('userProfile.validID.show');
        Route::get('/user-profile/vaccineCard/{id}', [UserProfileController::class, 'showVaccineCard'])->name('userProfile.vaccineCard.show');

        Route::get('/hostelresidents',[UserController::class, 'HostelResidents'])->name('hostelresidents');
        Route::get('/hostelresidents/create', [UserController::class, 'StoreHostelResidents'])->name('hostelresidents.create');
        Route::post('/hostelresidents', [UserController::class, 'StoreDormitoryResidents'])->name('hostelresidents.store');
        Route::get('/hostelresidents/{id}/edit', [UserController::class, 'EditHostelResidents'])->name('hostelresidents.edit');
        Route::patch('/hostelresidents/{id}', [UserController::class, 'UpdateHostelResidents'])->name('hostelresidents.update');
        Route::delete('/hostelresidents/{id}', [UserController::class, 'DeleteHostelResidents'])->name('hostelresidents.destroy');

        Route::get('/dormitoryrooms', [DormitoryRoomController::class, 'DormitoryRooms'])->name('dormitoryrooms');
        Route::post('/dormitoryrooms', [DormitoryRoomController::class, 'addRoom'])->name('dormitory.addRoom');
        Route::put('/dormitoryrooms/{id}', [DormitoryRoomController::class, 'updateRoom'])->name('dormitory.updateRoom');
        Route::get('/dormitoryrooms/{id}', [DormitoryRoomController::class, 'showbed'])->name('dormitory.showbed');

        Route::get('/hostelrooms',[HostelRoomController::class, 'HostelRooms'])->name('hostelrooms');
        Route::post('/hostelrooms', [HostelRoomController::class, 'addRoom'])->name('hostel.addRoom');
        Route::put('/hostelrooms/{id}', [HostelRoomController::class, 'updateRoom'])->name('hostel.updateRoom');

        Route::get('/reservations',[ReservationController::class, 'reservations'])->name('reservations');
        Route::put('/reservations/{id}', [ReservationController::class, 'updateReservation'])->name('admin.updateReservation');

        Route::get('/announcements',[AnnouncementController::class, 'announcements'])->name('announcements');
        Route::post('/announcements',[AnnouncementController::class, 'store'])->name('announcement.store');
        Route::put('/announcement/{id}',[AnnouncementController::class, 'update'])->name('announcement.update');

        Route::get('/payments',[PaymentController::class, 'payments'])->name('payments');
        Route::get('/maintenancerequests',[MaintenanceRequestController::class, 'maintenancerequests'])->name('maintenancerequests');
        Route::post('/assignUser',[MaintenanceRequestController::class, 'assignUser'])->name('admin.assignUser');


        Route::get('/lostandfounds',[LostAndFoundController::class, 'lostandfounds'])->name('lostandfounds');
        Route::post('/addItem',[LostAndFoundController::class, 'addItem'])->name('admin.addItem');
        Route::put('/updateItem/{id}',[LostAndFoundController::class, 'updateItem'])->name('admin.updateItem');

        Route::get('/violations',[ViolationController::class, 'violations'])->name('violations');
        Route::get('/visitors',[VisitorController::class, 'visitors'])->name('visitors');
        Route::get('/logs',[LogController::class, 'logs'])->name('logs');
        Route::get('/sleeplogs',[LogController::class, 'sleeplogs'])->name('sleeplogs');

        Route::get('/complaints',[ComplaintController::class, 'complaints'])->name('complaints');

        Route::get('/getTotalRevenue', [DashboardController::class,'getTotalRevenue'])->name('getTotalRevenue');
        Route::get('/getDashboardData', [DashboardController::class,'getDashboardData'])->name('getDashboardData');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/payments',[PaymentController::class, 'myPayments'])->name('user.payments');
        Route::post('/payments', [PaymentController::class, 'updateUserPayment'])->name('user.payments.update');
        Route::get('/viewpayment/{id}',[PaymentController::class, 'viewpayment'])->name('user.viewpayment');
        Route::get('/maintenance',[MaintenanceRequestController::class, 'myRequest'])->name('user.maintenance');
        Route::get('/lostandfound',[LostAndFoundController::class, 'viewLostItems'])->name('user.lostandfound');
        Route::get('/logs',[LogController::class, 'mylogs'])->name('user.logs');
        Route::get('/sleeplogs',[LogController::class, 'mysleeplogs'])->name('user.sleeplogs');

        Route::get('/complaints',[ComplaintController::class, 'mycomplaints'])->name('user.complaints');
        Route::post('/schedule',[LaundryController::class, 'schedule'])->name('user.schedule');

        Route::post('/addFoundItem',[LostAndFoundController::class, 'addFoundItem'])->name('user.addFoundItem');
        Route::post('/requestmaintenance',[MaintenanceRequestController::class, 'requestmaintenance'])->name('user.requestmaintenance');
    });

    Route::group(['prefix' => 'maintenance'], function() {
        Route::post('/addStatus/{id}',[MaintenanceRequestController::class, 'addStatus'])->name('maintenance.status.store');
    });

});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function() {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});


//Error Page Route
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});


//Table Page Routs
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});
//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');
