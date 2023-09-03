<?php

use App\Http\Controllers\Tenant\Modules\System\Security\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

Route::get('/welcome', function (Request $request) {
    dd('Welcome landlord');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('landlord.login');
    Route::post('/authenticate', 'authenticate')->name('landlord.authenticate');
    Route::get('/dashboard', 'dashboard')->name('landlord.dashboard');
    Route::post('/logout', 'logout')->name('landlord.logout');
});