<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloodgateController; // For web FloodgateController

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

Route::get('/', [FloodgateController::class, 'index']); // Changed to point to controller

Route::post('/search', [FloodgateController::class, 'search'])->name('floodgate.search');
