<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckVerified;
use App\Http\Middleware\CheckStatus;

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

//resetpass

Route::get('/user/reset-password/{user}/{token}', [App\Http\Controllers\UserController::class, 'reset_passwd'])->name('user.reset.passwd');
Route::put('/user/reset-password/{user}', [App\Http\Controllers\UserController::class, 'reset_passwd_validate'])->name('user.reset.validate.passwd');
//activation

Route::get('/user/change-password/{user}/{token}', [App\Http\Controllers\UserController::class, 'change_pass'])->name('user.change.pass');
Route::put('/user/activate-account/{user}', [App\Http\Controllers\UserController::class, 'change_pass_validate'])->name('user.validate.pass');

Auth::routes();

Route::group(['middleware' => ['unverified_user']], function(){
    Route::get('/user/change-password/', [App\Http\Controllers\UserController::class, 'change_password'])->name('user.change.password');
    Route::put('/user/change-password/{user}', [App\Http\Controllers\UserController::class, 'change_password_validate'])->name('user.validate.password');

});
Route::group(['middleware' => ['auth']], function(){

    Route::group(['middleware' => ['verified_user', 'checkstatus']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
    Route::get('/requests', [App\Http\Controllers\RequestController::class, 'index'])->name('requests');
    Route::get('/requests/create', [App\Http\Controllers\RequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/create', [App\Http\Controllers\RequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/history', [App\Http\Controllers\RequestController::class, 'history'])->name('requests.history');
    Route::get('/requests/edit/{request}', [App\Http\Controllers\RequestController::class, 'edit'])->name('requests.edit');
    Route::post('/requests/update/{request}', [App\Http\Controllers\RequestController::class, 'update'])->name('requests.update');
    Route::post('/requests/cancel/{request}', [App\Http\Controllers\RequestController::class, 'cancel'])->name('requests.cancel');
    Route::get('/bank_holidays', [App\Http\Controllers\BankHolidaysController::class, 'index'])->name('bank.index');
    Route::get('/bank_holidays/annees/listing/{id}', [App\Http\Controllers\BankHolidaysController::class, 'listing'])->name('bank.listing');
    Route::post('/bank_holidays/create', [App\Http\Controllers\BankHolidaysController::class, 'store'])->name('bank.store');
    Route::post('/bank_holidays/create_year', [App\Http\Controllers\BankHolidaysController::class, 'year'])->name('bank.year');
    Route::post('/delete', [App\Http\Controllers\BankHolidaysController::class, 'destroy'])->name('bank.destroy');
    Route::get('/bank_holidays/update/{id}', [App\Http\Controllers\BankHolidaysController::class,'update'])->name('bank.update');
    Route::get('/bank_holidays/annees/listing/filtreType/{type}/{year}', [App\Http\Controllers\BankHolidaysController::class, 'filtreType'])->name('bank.filtretype');
    Route::get('/bank_holidays/annees', [App\Http\Controllers\BankHolidaysController::class, 'annees'])->name('bank.annees');
    Route::get('/setting/cron', [App\Http\Controllers\UserController::class, 'cron'])->name('setting.cron');
    Route::post('/setting/cron/update', [App\Http\Controllers\UserController::class, 'cron_update'])->name('setting.cron_update');
    });

    Route::group(['middleware' => ['admin']], function(){

        Route::group(['prefix'=>'/admin'], function(){

            Route::get('/candidat', [App\Http\Controllers\AdminController::class, 'candidat'])->name('admin.candidat');
            Route::get('/candidat/create', [App\Http\Controllers\AdminController::class, 'candidat_create'])->name('admin.candidat_create');
            Route::post('/candidat/create', [App\Http\Controllers\AdminController::class, 'store_c'])->name('admin.store_c');
            Route::get('/candidat/edit/{candidat}', [App\Http\Controllers\AdminController::class, 'edit_c'])->name('admin.edit_candidat');
            Route::post('/candidat/update/{candidat}', [App\Http\Controllers\AdminController::class, 'update_c'])->name('admin.update_c');
            Route::get('/candidat/search',[App\Http\Controllers\AdminController::class, 'search'])->name('candidat.search');
            Route::get('/candidat/TH', [App\Http\Controllers\AdminController::class, 'TH'])->name('admin.TH');
            Route::get('/candidat/add_T', [App\Http\Controllers\AdminController::class, 'add_T'])->name('admin.add_T');
            Route::post('candidat/add_T', [App\Http\Controllers\AdminController::class, 'store_T'])->name('admin.store_T');
            Route::get('/candidat/add_H', [App\Http\Controllers\AdminController::class, 'add_H'])->name('admin.add_H');
            Route::post('candidat/add_H', [App\Http\Controllers\AdminController::class, 'store_H'])->name('admin.store_H');
            Route::get('candidat/edit_h/{hobies}', [App\Http\Controllers\AdminController::class, 'edit_h'])->name('admin.edit_h');
            Route::post('candidat/update_h/{hobies}', [App\Http\Controllers\AdminController::class, 'update_h'])->name('admin.update_h');
            Route::get('candidat/edit_t/{technologies}', [App\Http\Controllers\AdminController::class, 'edit_t'])->name('admin.edit_t');
            Route::post('candidat/update_t/{technologies}', [App\Http\Controllers\AdminController::class, 'update_t'])->name('admin.update_t');
            Route::get('candidat/update_h_c_e/{hobies}', [App\Http\Controllers\AdminController::class, 'update_h_c_e'])->name('admin.update_h_c_e');
            Route::get('candidat/update_h_c_d/{hobies}', [App\Http\Controllers\AdminController::class, 'update_h_c_d'])->name('admin.update_h_c_d');
            Route::get('candidat/update_t_c_e/{technologies}', [App\Http\Controllers\AdminController::class, 'update_t_c_e'])->name('admin.update_t_c_e');
            Route::get('candidat/update_t_c_d/{technologies}', [App\Http\Controllers\AdminController::class, 'update_t_c_d'])->name('admin.update_t_c_d');
            Route::get('candidat/update_c_e/{candidat}', [App\Http\Controllers\AdminController::class, 'update_c_e'])->name('admin.update_c_e');
            Route::get('candidat/update_c_d/{candidat}', [App\Http\Controllers\AdminController::class, 'update_c_d'])->name('admin.update_c_d');
            

            Route::get('', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
            Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
            Route::post('/users/create', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
            Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
            Route::get('/users/edit/{user}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
            Route::get('/users/disable/{user}', [App\Http\Controllers\AdminController::class, 'disable'])->name('admin.disable');
            Route::get('/users/enable/{user}', [App\Http\Controllers\AdminController::class, 'enable'])->name('admin.enable');
            Route::get('/users/reset-password/{user}', [App\Http\Controllers\AdminController::class, 'reset_password'])->name('admin.reset');
            Route::put('/users/update/{user}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
         });
            Route::post('/requests/validate/{request}', [App\Http\Controllers\RequestController::class, 'validate_'])->name('requests.validate');
            Route::post('/requests/refuse/{request}', [App\Http\Controllers\RequestController::class, 'refuse'])->name('requests.refuse');
            Route::post('/requests/archive/{request}', [App\Http\Controllers\RequestController::class, 'archive'])->name('requests.archive');
            Route::post('/requests/unarchive/{request}', [App\Http\Controllers\RequestController::class, 'unarchive'])->name('requests.unarchive');
    });
});



Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
