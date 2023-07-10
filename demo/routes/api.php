<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\UserRegisterController;

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

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth-login');

Route::post('/register-user', [UserRegisterController::class, 'registerAction'])->name('register-user');

Route::group(['middleware' => ['apiJwt']], function () {

    Route::post('/address/create-address', [AddressController::class, 'createAction'])->name('create-address');

    Route::post('/bank-count/deposit', [BankAccountController::class, 'depositAction'])->name('deposit-bank-count');

    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
