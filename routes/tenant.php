<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Tenant\Modules\System\Security\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    dd('Welcome Tenant');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('tenant.register');
    Route::post('/store', 'store')->name('tenant.store');
    Route::get('/login', 'login')->name('tenant.login');
    Route::post('/authenticate', 'authenticate')->name('tenant.authenticate');
    Route::get('/dashboard', 'dashboard')->name('tenant.dashboard');
    Route::post('/logout', 'logout')->name('tenant.logout');
});