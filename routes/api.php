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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// NIUBIZ_URL_API=https://apisandbox.vnforappstest.com
// NIUBUZ_URL_JS=https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true    
// NIUBIZ_USER=integraciones@niubiz.com.pe
// NIUBIZ_PASSWORD=_7z3@8fF
// NIUBIZ_MERCHANT_ID=456879852
// NIUBIZ_CURRENCY=PEN
