<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// /price-m2/zip-codes/{zip_code}/aggregate/{max|min|avg}?construction_type={1-7}
Route::get(
    '/price-m2/zip-codes/{zip_code}/aggregate/{aggregate}/construction_type/{construction_type?}', 
    [PriceController::class, 'index'])
    ->whereIn('aggregate', ['max', 'min', 'avg'])
    ->where('construction_type', '[0-7]');

