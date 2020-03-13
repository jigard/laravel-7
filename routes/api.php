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

Route::middleware('auth:api')->get('/user','ProfileController@index');

// airlock package api
Route::prefix('airlock')->group(function(){
    Route::post('/register','API\AuthController@register');
    Route::post('/token','API\AuthController@token');
});

Route::middleware('auth:airlock')->get('/name',function(Request $request){
    return response()->json(['name'=>$request->user()->name]);
});

Route::get('/apiCors',function(Request $request){
 return response()->json(['testing cors in laravel 7']);
});