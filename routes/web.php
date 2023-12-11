<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


//this route are show verfication page
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('resent-email', [HomeController::class, 'resend'])->name('verification.resend');

//home and password change
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/password/change', [HomeController::class, 'password_change'])->middleware('auth')->name('password.change');
Route::post('/password/update', [HomeController::class, 'update_password'])->middleware('auth','verified')->name('update.password');


//Role Create
Route::group(['middleware' => ['auth', 'admin']], function(){
    
    Route::get('role/index', [RoleController::class, 'index'])->middleware('auth','admin')->name('role.index');
    Route::get('role/create', [RoleController::class,'create'])->middleware('auth','admin')->name('role.create');
    Route::post('role/store', [RoleController::class,'store'])->middleware('auth','admin')->name('role.store');
    Route::get('role/edit/{id}', [RoleController::class,'edit'])->middleware('auth','admin')->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class,'update'])->middleware('auth','admin')->name('role.update');
    Route::get('role/delete/{id}', [RoleController::class,'destroy'])->middleware('auth','admin')->name('role.delete');


    //User Create
    Route::get('user/index', [UserController::class, 'index'])->middleware('auth','admin')->name('user.index');
    Route::get('user/create', [UserController::class,'create'])->middleware('auth','admin')->name('user.create');
    Route::post('user/store', [UserController::class,'store'])->middleware('auth','admin')->name('user.store');
    Route::get('user/edit/{id}', [UserController::class,'edit'])->middleware('auth','admin')->name('user.edit');
    Route::post('user/update/{id}', [UserController::class,'update'])->middleware('auth','admin')->name('user.update');
    Route::get('user/delete/{id}', [UserController::class,'destroy'])->middleware('auth','admin')->name('user.delete');

    // Product 
    Route::resource('products', ProductController::class);

});

