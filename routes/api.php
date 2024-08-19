<?php

use App\Http\Controllers\Customers\CreateCustomerController;
use App\Http\Controllers\Products\GetProductsController;
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

Route::get('authZoho2', function() {
    $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
        'code' => '1000.7d26e26e1ae65b517d2fd758635b7941.df336066ac74e2246f75aeff12872bd0',
        'client_id' => '1000.4QCO0132SG66R8N3R113FO2VFJBB8Q',
        'client_secret' => '27978a1b5eb1897aba48b7b94f972a7b44777ebafb',
        'redirect_uri' => 'http://127.0.0.1:8000/api/authZoho',
        'grant_type' => 'authorization_code',
    ]);

    // To get the response body as an array
    $responseBody = $response->json();

    // If you need to check the status code or handle the response differently
    if ($response->successful()) {
        // Log::info('reponse zoho: '. $responseBody);
        $config = Config::updateOrCreate([
            Config::ORGANIZATION_ID => '860147291',
        ],[
            Config::ORGANIZATION_ID => '860147291',
            Config::DATA => json_decode(json_encode($responseBody))
        ]);
        dd('worked', $config, $responseBody);
    } else {
        dd($responseBody, $response->status());
        // Handle error
        // $response->status() will give you the HTTP status code
    }
});

Route::get('/products', GetProductsController::class);
Route::post('/customer', CreateCustomerController::class);
Route::post('/hostedpages' , CreateHostedPageController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
