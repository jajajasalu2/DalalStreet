<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Company;
use App\Team;

Route::get('/', function () {
	return view('dalal');
});

Route::get('/home', function () {
	return view('dalal');
});


Route::get('/teams',['middleware'=>['auth','counter'],'uses'=>'TeamController@show_all']);

Route::get('/companies',['middleware'=>['auth'],'uses'=>'CompanyController@show_all']);

Route::post('/create',['middleware'=>['auth','counter'],'uses'=>'TransactionController@create']);

Route::get('/flush',['middleware'=>['auth','admin'],'uses'=>'TransactionController@session_end']);

Route::get('/transactions/{id}',['middleware'=>['auth'],'uses'=>'TransactionController@show']);

Route::post('/delete/company',['middleware'=>['auth','admin'],'uses'=>'CompanyController@delete']);

Route::get('/edit/company/{id}',['middleware'=>['auth','admin'],'uses'=>'CompanyController@edit']);

Route::get('/create/company',['middleware'=>['auth','admin'],'uses'=>'CompanyController@create']);

Route::post('/store/company','CompanyController@store');

Route::post('/update/company','CompanyController@update');  

Route::get('/admin',['middleware'=>['auth','admin'],'uses'=>'AdminController@dashboard']);

Route::get('/team/{id}',['middleware'=>['auth'],'uses'=>'TeamController@profile']);

Route::get('/company/{id}',['middleware'=>['auth'],'uses'=>'CompanyController@show']);

Auth::routes();

