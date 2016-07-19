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
    Route::get('manajemen_point','HomeController@manajemen_point');
    Route::get('manajemen_point/{id}','HomeController@manajemen_point');
    Route::get('manajemen_halte/{id}','HomeController@manajemen_halte');
    Route::get('manajemen_halte','HomeController@manajemen_halte');
    Route::get('manajemen_koridor/{id}','HomeController@manajemen_koridor');
    Route::get('manajemen_koridor','HomeController@manajemen_koridor');
    Route::get('manajemen_rute/{id}','HomeController@manajemen_rute');
    Route::get('manajemen_rute','HomeController@manajemen_rute');
    Route::get('halte','HomeController@halte');
    Route::get('halte_k1a','HomeController@halte_k1a');
   
   
    Route::get('test','HomeController@testline');
    Route::get('koridor_all','HomeController@koridor_all');    
    Route::get('halte_ungroup','HomeController@halte_ungroup');
    Route::get('halte_form','HomeController@halte_form');
    Route::get('ungroup','HomeController@ungroup');
    Route::get('pencarian/{awal}/{akhir}','HomeController@pencarian');
    Route::get('pencarian_halte/{awal}/{akhir}','HomeController@pencarian_halte');
    Route::get('pencarian_optimal/{awal}/{akhir}','HomeController@pencarian_optimal');
    Route::get('menampilkan_halte/{awal}/{akhir}','HomeController@menampilkan_halte');

    Route::get('k_all','HomeController@k_all');
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

    Route::get('tambah_halte','HomeController@tambah_halte');
    Route::post('tambah_halte','HomeController@tambah_halte');
    Route::get('tambah_point','HomeController@tambah_point');
    Route::post('tambah_point','HomeController@tambah_point');
    Route::get('tambah_koridor','HomeController@tambah_koridor');
    Route::post('tambah_koridor','HomeController@tambah_koridor');
    Route::get('tambah_rute','HomeController@tambah_rute');
    Route::post('tambah_rute','HomeController@tambah_rute');

    Route::get('edit_halte/{id}','HomeController@edit_halte');
    Route::post('edit_halte/{id}','HomeController@edit_halte');
    Route::get('edit_point/{id}','HomeController@edit_point');
    Route::post('edit_point/{id}','HomeController@edit_point');
    Route::get('edit_koridor/{id}','HomeController@edit_koridor');
    Route::post('edit_koridor/{id}','HomeController@edit_koridor');
    Route::get('edit_rute/{id}','HomeController@edit_rute');
    Route::post('edit_rute/{id}','HomeController@edit_rute');

    Route::get('delete_point/{id}','HomeController@delete_point');
    Route::get('delete_halte/{id}','HomeController@delete_halte');
    Route::get('delete_koridor/{id}','HomeController@delete_koridor');
    Route::get('delete_rute/{id}','HomeController@delete_point');  
});
