<?php

use App\Http\Controllers\Customers\CreateCustomerController;
use App\Http\Controllers\Products\GetProductsController;
use App\Http\Controllers\Products\ShowProductController;
use App\Http\Controllers\Transactions\CreateHostedPageController;
use App\Models\Config;
use Illuminate\Support\Facades\Http;
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


Route::get('authZoho', function() {
    return 'ok';
});

Route::get('/products', GetProductsController::class);
Route::get('/products/{id}', ShowProductController::class);
Route::post('/customer', CreateCustomerController::class);
Route::post('/hostedpages' , CreateHostedPageController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
