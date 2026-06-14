<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- المسارات العامة ---
Route::get('/', function () { return view('welcome'); });
Route::get('/Home', function () {
    return view('Home');
})->name('Home');


Route::get('/Services/Servicedetails./{id}', [ServiceController::class, 'show'])->name('Services.Servicedetails');
Route::get('/Services/Services', [ServiceController::class, 'indexServices'])->name('Services.Services');
Route::get('/Home', [HomeController::class, 'index'])->name('Home');

Route::get('/SinUp', function () { return view('SinUp.sinup'); })->name('SinUp.sinup');
Route::get('/register/user', function () { return view('auth.register_user'); })->name('register.user');
Route::get('/register/nurse', function () { return view('auth.register_nurse'); })->name('register.nurse');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');


// --- معالجة البيانات (POST/PUT/DELETE) ---
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user.post');
Route::post('/register/nurse', [AuthController::class, 'registerNurse'])->name('register.nurse.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update-password-action', [AuthController::class, 'updatePassword'])->name('password.update.custom');

// --- مسارات المحمية بـ Auth ---
Route::middleware(['auth'])->group(function () {

    // 1. مسارات  (Admin)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/add-user', [DashboardController::class, 'AddUser'])->name('adduser');
        Route::post('/add-nurse', [DashboardController::class, 'AddNurse'])->name('addNurse');
        Route::patch('/approve/{id}', [DashboardController::class, 'approveNurse'])->name('approve');
        Route::patch('/reject/{id}', [DashboardController::class, 'reject'])->name('reject');
        Route::get('/nurse-profile/{id}', [DashboardController::class, 'showNurse'])->name('nurseProfile');
        Route::get('/nurse/edit/{id}', [DashboardController::class, 'editNurse'])->name('nurse.edit');
        Route::put('/nurse/update/{id}', [DashboardController::class, 'updateNurse'])->name('nurse.update');
        Route::put('/patients/update/{id}', [DashboardController::class, 'updatePatient'])->name('patients.update');
        Route::get('/login-as/{id}', [DashboardController::class, 'loginAsUser'])->name('loginAsUser');

        // الخدمات للمسؤول
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
        Route::put('/services/update/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/delete/{id}', [ServiceController::class, 'destroy'])->name('services.delete');
    });

    Route::delete('/patient/delete/{id}', [DashboardController::class, 'deletePatient'])->name('admin.patient.delete');
    Route::delete('/nurse/delete/{id}', [DashboardController::class, 'deleteNurse'])->name('nurse.delete');
    Route::post('/update-password-forced', [DashboardController::class, 'updateTempPassword'])->name('update.temp.password');


    Route::prefix('nurse')->name('nurse')->group(function () {
        Route::get('/dashboard', [NurseController::class, 'index'])->name('dashboard');

    });



});


Route::get('/admin/return-to-admin', [DashboardController::class, 'returnToAdmin'])->name('admin.return');


Route::get('/admin/global-search', [SearchController::class, 'globalSearch'])
     ->name('admin.global.search')
     ->middleware('auth');
Route::get('/search', [HomeController::class, 'search'])->name('search');
// =========================================================
// مسارات لوحة تحكم الممرض (Nurse Routes) - النسخة النهائية
// =========================================================
Route::get('/Nurse/nurses', [NurseController::class, 'index'])->name('Nurse.nurses');
Route::get('/nurse/{id}', [NurseController::class, 'show'])->name('nurse.profile');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////اكواد الممرض
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/Services/order/{id}', [OrderController::class, 'order'])->name('Orders.order')->middleware('auth');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');

Route::put('/orders/{id}', [OrderController::class, 'update'])->name('Orders.update');
Route::patch('/orders/{id}', [OrderController::class, 'destroy'])->name('Orders.destroy');
Route::post('/orders/{id}/rate', [OrderController::class, 'storeRating'])->name('orders.storeRating');
Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus']);
Route::get('/nurse/dashboard', [NurseController::class, 'index']);
Route::post('/order/{id}/accept', [NurseController::class, 'accept'])->name('order.accept');
Route::post('/order/{id}/reject', [NurseController::class, 'reject'])->name('order.reject');
Route::post('/orders/{id}/update', [OrderController::class, 'updateStatu']);
////////////////////////////////////////

Route::get('/profile/edit', [PatientController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [PatientController::class, 'update'])->name('profile.update');

///////////////////////////////////////
Route::get('/nurse/{id}/reviews', [NurseController::class, 'showReviews'])->name('Nurse.reviews');
// تأكدي من كتابته بأحرف صغيرة لتجنب الأخطاء
Route::get('/nurse/dashboard', [NurseController::class, 'dashboard'])->name('Nurse.dashboard');
Route::get('/nurse/profile/edit', [NurseController::class, 'editProfile'])->name('nurse.profile.edit');
Route::put('/nurse/profile/update', [NurseController::class, 'updateProfile'])->name('nurse.profile.update');
Route::get('/orders/{Id}', [NurseController::class, 'someFunction'])->name('nurse.order');
// تأكد من وجود هذا السطر في routes/web.php
Route::get('/nurse', [NurseController::class, 'myOrders'])->name('nurse.all_orders');
// أضف هذا المسار ليعمل الرابط الذي يسبب الخطأ
Route::get('/orders/details/{orderId}', [NurseController::class, 'showOrder'])->name('orders.showOrder');
Route::patch('/orders/{id}/hide', [NurseController::class, 'hideOrder'])->name('Orders.hide');

// مسار صفحة الطلبات المقبولة
Route::get('/accepted', [NurseController::class, 'acceptedOrders'])->name('orders.accepted');
Route::patch('/orders/{id}/complete', [NurseController::class, 'completeOrder'])
     ->name('orders.complete');
Route::get('/nursesearch', [App\Http\Controllers\NurseController::class, 'searchNurs'])
     ->name('nurse.search.results');
Route::patch('/admin/nurse/{id}/suspend', [DashboardController::class, 'suspendNurse'])
     ->name('admin.suspend');
// بدلاً من استخدام PUT فقط، استخدم match ليدعم النوعين

Route::post('/orders/{id}/cancel', [NurseController::class, 'cancelOrder'])
    ->name('orders.cancel');
    Route::get('/home', [HomeController::class, 'index'])->name('guest.index');
Route::post('/orders/confirm-cancel', [OrderController::class, 'confirmCancel'])->name('orders.confirm-cancel');
