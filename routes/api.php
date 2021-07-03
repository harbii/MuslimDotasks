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

Route::post ( '/product' , [ 'uses' => 'ProductController@create' , 'as' => 'api.product.create' ] ) ;
Route::get  ( '/product' , [ 'uses' => 'ProductController@search' , 'as' => 'api.product.search' ] ) ;
