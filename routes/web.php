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
Route::get('/', [HomeController::class ,'index']);
Route::get('/home', [HomeController::class ,'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware([isAdmin::class])->group(function(){
        Route::get('/view_doctors',[AdminController::class, 'doctorList']);
        Route::post('/add_doctor',[AdminController::class, 'addDoctor']);
        Route::delete('/delete_doctor/{id}',[AdminController::class, 'deleteDoctor']);
        Route::get('/edit_doctor/{id}',[AdminController::class, 'editDoctor']);
        Route::post('/update_doctor/{id}',[AdminController::class, 'updateDoctor']);
    });
    
});
