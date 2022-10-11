<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\isAdmin;

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
// GENERAL METHODS
Route::get('/', [HomeController::class ,'index']);
Route::get('/home', [HomeController::class ,'redirect']);
// LOGGED IN ONLY METHODS
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // ADMIN ONLY METHODS
    Route::middleware([isAdmin::class])->group(function(){
        Route::get('/view_doctors',[AdminController::class, 'doctorList']);
        Route::post('/add_doctor',[AdminController::class, 'addDoctor']);
        Route::delete('/delete_doctor/{id}',[AdminController::class, 'deleteDoctor']);
        Route::get('/edit_doctor/{id}',[AdminController::class, 'editDoctor']);
        Route::post('/update_doctor/{id}',[AdminController::class, 'updateDoctor']);
        Route::get('/view_appointments',[AdminController::class, 'viewAppointments']);
        Route::post('/status_approved/{id}',[AdminController::class, 'statusApproved']);
        Route::post('/status_rejected/{id}',[AdminController::class, 'statusRejected']);
        Route::post('/send_email/{id}',[AdminController::class, 'sendEmail']);
    });
    // USER ONLY METHODS
    Route::middleware([isUser::class])->group(function(){
        Route::post('/add_appointment',[HomeController::class,'bookAppointment']);
        Route::get('/user_appointments',[HomeController::class,'appointmentsList']);
        Route::delete('/user_delete_appointment/{id}',[HomeController::class,'deleteAppointment']);
    });
});
