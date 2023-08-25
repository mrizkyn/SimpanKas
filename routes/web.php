<?php

use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FixedassetsController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ParsingController;
use App\Http\Controllers\StatementController;
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
Route::get('income', [IncomeController::class, 'index']);
Route::get('income/create', [IncomeController::class, 'create']);
Route::post('income/store', [IncomeController::class, 'store']);

//Expenditure
Route::get('expenditure', [ExpenditureController::class, 'index']);
Route::get('expenditure/create', [ExpenditureController::class, 'create']);
Route::post('expenditure/store', [ExpenditureController::class, 'store']);
Route::get('/expenditure/getnoakun', [ParsingController::class, 'getNoAkunOptions']);
route::get('/get-child',[ExpenditureController::class,'getChildAccounts'])->name('get.child');
Route::get('/check-code', [ExpenditureController::class, 'checkCode'])->name('check.code');


//Debt
Route::get('debt', [DebtController::class, 'index']);
Route::post('debt/store', [DebtController::class, 'store']);
Route::post('/debt/{id}/toggle-status', [DebtController::class, 'toggleStatus'])->name('debt.toggleStatus');

//Receivables
Route::get('receivables', [ReceivablesController::class, 'index']);
Route::post('receivables/store', [ReceivablesController::class, 'store']);
Route::post('/Receivables/{id}/toggle-status', [ReceivablesController::class, 'toggleStatus'])->name('Receive.toggleStatus');

//Account
Route::get('account', [AccountController::class, 'index'])->name('accounts.index');
Route::POST('account/store', [AccountController::class, 'store'])->name('account.store');
Route::POST('account/update/{id}', [AccountController::class, 'update'])->name('account.update');
Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
route::get('/get-child',[ParsingController::class,'getChildAccounts'])->name('get.child');
Route::get('/get/last_code', [ParsingController::class, 'checkCodeExists'])->name('get.last_code');
Route::get('/check-code', [ParsingController::class, 'checkCode'])->name('check.code');


//Assets
route::get('asset', [FixedassetsController::class, 'index']);


//Report

route::get('/statement', [StatementController::class,'index'])->name('statement.index');




