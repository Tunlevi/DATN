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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::post('auth/login','ApiAuthController@login');
    Route::post('auth/register','ApiAuthController@register');
    Route::post('auth/info','ApiAuthController@info')->middleware('auth:api');
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'category'], function (){
        Route::get('','ApiCategoryController@index');
        Route::get('show/{id}','ApiCategoryController@show');
    });
    Route::group(['prefix' => 'product'], function (){
        Route::get('','ApiProductController@index');
        Route::get('show/{id}','ApiProductController@show');
    });

    Route::group(['prefix' => 'user'], function (){
        Route::put('update','ApiUserController@update')->middleware('auth:api');
    });
    Route::group(['prefix' => 'upload'], function (){
        Route::post('image','ApiUploadController@uploadImage')->middleware('auth:api');
    });

    Route::group(['prefix' => 'order'], function (){
        Route::get('','ApiOrderController@index');
        Route::get('show/{id}','ApiOrderController@show');
        Route::post('add','ApiOrderController@add');
        Route::put('update-cancel-paid','ApiOrderController@cancelStatusPaid');
    });

    Route::group(['prefix' => 'vote'], function (){
        Route::get('','ApiVoteController@index');
        Route::get('static/{id}','ApiVoteController@static');
        Route::post('','ApiVoteController@store');
        Route::get('show/{id}','ApiVoteController@show');
        Route::put('update-cancel-paid','ApiVoteController@cancelStatusPaid');
    });
});
