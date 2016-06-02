<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('index','HomeController@index');
    Route::get('koridor','HomeController@koridor');
    Route::get('jadwal','HomeController@jadwal');
    Route::get('halte','HomeController@halte');
    Route::get('halte_k1a','HomeController@halte_k1a');
   
    Route::get('test','HomeController@testline');
    Route::get('halte_ungroup','HomeController@halte_ungroup');
    Route::get('ungroup','HomeController@ungroup');

    Route::get('k1','HomeController@k1');
    Route::get('k2','HomeController@k2');
    Route::get('k3','HomeController@k3');
    Route::get('k5','HomeController@k5');
    Route::get('k6','HomeController@k6');

    Route::get('rute1a','HomeController@rute1a');
    Route::get('rute2a','HomeController@rute2a');    
    Route::get('rute3a','HomeController@rute3a');
    Route::get('rute5a','HomeController@rute5a');
    Route::get('rute6a','HomeController@rute6a');
    Route::get('rute1b','HomeController@rute1b');
    Route::get('rute2b','HomeController@rute2b');
    Route::get('rute3b','HomeController@rute3b');
    Route::get('rute5b','HomeController@rute5b');
    Route::get('rute6b','HomeController@rute6b');

    Route::get('halte_k1a','HomeController@halte_k1a');
    Route::get('halte_ka1a','HomeController@halte_ka1a');
    Route::get('halte_k2a','HomeController@halte_k2a');    
    Route::get('halte_k3a','HomeController@halte_k3a');
    Route::get('halte_k5a','HomeController@halte_k5a');
    Route::get('halte_k6a','HomeController@halte_k6a');
    Route::get('halte_k1b','HomeController@halte_k1b');
    Route::get('halte_k2b','HomeController@halte_k2b');
    Route::get('halte_k3b','HomeController@halte_k3b');
    Route::get('halte_k5b','HomeController@halte_k5b');
    Route::get('halte_k6b','HomeController@halte_k6b');
});
