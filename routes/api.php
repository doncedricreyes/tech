<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/customer')->middleware('apiCustomer')->group(function() {
    Route::post('/login','Api\CustomerController@login');
    Route::get('/', 'Api\CustomerController@index');
    Route::get('/service','Api\CustomerController@getBrands');
    Route::get('/service/products','Api\CustomerController@getProducts');
    Route::get('/service/products/ticket','Api\CustomerController@ticket');
    Route::get('/service/products/ticket/search','Api\CustomerController@search_ticket');
    Route::get('/service/tickets','Api\CustomerController@getTickets');
    Route::get('/service/tickets/{id}','Api\CustomerController@viewTickets');
    Route::post('/service/tickets/{id}/message','Api\CustomerController@send_message');
    Route::post('/service/products/ticket/submit','Api\CustomerController@send_ticket');


});

Route::prefix('/repair')->group(function() {
    Route::get('/', 'Api\RepairController@index');
    Route::get('/repairs', 'Api\RepairController@getRepair');
    Route::get('/repairs/{id}', 'Api\RepairController@viewRepair');
    Route::get('/repairs/{id}', 'Api\RepairController@viewRepair');
    Route::get('/search/repairs','Api\RepairController@search_repair');
    Route::get('/inventory','Api\RepairController@inventory');
    Route::get('/inventory/orders','Api\RepairController@getOrder');
    Route::get('/inventory/orders/search','Api\RepairController@search_order');
    Route::get('/inventory/requests','Api\RepairController@getRequest');
    Route::get('/inventory/requests/search','Api\RepairController@search_request');
});