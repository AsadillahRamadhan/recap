<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard.index', [ 'title' => 'Dashboard', 'active' => 'dashboard']);
});

Route::get('/products', [ProductController::class, 'all']);
Route::resource('/product', ProductController::class);
Route::post('/product/{id}/terjual', [ProductController::class, 'terjual']);

Route::get('/histories', [HistoryController::class, 'index']);
Route::resource('/history', HistoryController::class);
