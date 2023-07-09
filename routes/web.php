<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;

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




Route::get('/', [DashboardController::class, 'index']);



//Income
Route::get('Income', [IncomeController::class, 'index']);
Route::get('Income/create', [IncomeController::class, 'create']);
Route::post('Income/store', [IncomeController::class, 'store']);


//Debt
Route::get('Debt', [DebtController::class, 'index']);
Route::get('Debt/create', [DebtController::class, 'create']);
Route::post('Debt/store', [DebtController::class, 'store']);


