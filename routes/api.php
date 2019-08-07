<?php

use Illuminate\Http\Request;
use App\Models\Product;
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

// Route::middleware('auth:api')->prefix('v1')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(['namespace'=>'Api'],function() {
	Route::get('/test', function () {

    		return Product::get()->toArray();
	});
});

