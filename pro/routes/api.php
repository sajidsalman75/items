<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ItemController;
use App\Http\Controllers\DiscountController;

Route::apiResource('items', ItemController::class);
Route::post('discounts', [DiscountController::class, 'store']);
Route::delete('discounts/{id}', [DiscountController::class, 'destroy']);

