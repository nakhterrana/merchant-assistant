<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;



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

URL::forceScheme('https');

Route::prefix('auth')->group(function () {
    Route::get('install', [AuthController::class, 'install']);

    Route::middleware(['verifyBigCRequest'])->group(function () {
        Route::get('load', [AuthController::class, 'load']);
        Route::get('uninstall', [AuthController::class, 'uninstall']);
    });
});


Route::get('/{url?}', function () {
    return view('app');
});
