<?php

use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReceivablesController ;

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

//Expenditure
Route::get('Expenditure', [ExpenditureController::class, 'index']);
Route::get('Expenditure/create', [ExpenditureController::class, 'create']);
Route::post('Expenditure/store', [ExpenditureController::class, 'store']);

//Debt
Route::get('Debt', [DebtController::class, 'index']);
Route::post('Debt/store', [DebtController::class, 'store']);
Route::post('/debt/{id}/toggle-status', [DebtController::class, 'toggleStatus'])->name('debt.toggleStatus');

//Receivables
Route::get('Receivables', [ReceivablesController::class, 'index']);
Route::post('Receivables/store', [ReceivablesController::class, 'store']);
Route::post('/Receivables/{id}/toggle-status', [ReceivablesController::class, 'toggleStatus'])->name('Receive.toggleStatus');

//Account
Route::get('Account', [AccountController::class, 'index']);
Route::get('Account/create', [AccountController::class, 'create']);
Route::POST('Account/store', [AccountController::class, 'store']);
Route::POST('Account/update/{id}', [AccountController::class, 'update'])->name('account.update');






