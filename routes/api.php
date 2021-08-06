<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/all_kategori', 'App\Http\Controllers\API\KadoController@kategori');
Route::post('/all_kado', 'App\Http\Controllers\API\KadoController@index');
// Route::post('/detail_kado/{id}/{slug}', 'App\Http\Controllers\KadoController@detailKado');

// Route::post('/login', 'App\Http\Controllers\UserController@login');
// Route::post('/logout', 'App\Http\Controllers\UserController@logout');


// Route::group(['middleware' => 'auth:api'], function(){
// 	Route::post('/details', 'App\Http\Controllers\UserController@details');
// });
