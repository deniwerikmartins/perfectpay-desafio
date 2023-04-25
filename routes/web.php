<?php

use App\Http\Controllers\PaymentController;
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

Route::get('/', [PaymentController::class, 'index'])->name('payments.index');

Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

Route::get('/success', [PaymentController::class, 'show'])->name('payments.success');
