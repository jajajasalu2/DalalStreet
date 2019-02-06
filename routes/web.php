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
    $companies = Company::all();
    $teams = Team::all();
    return view('home')->with('companies',$companies)
                       ->with('teams',$teams);
});

Route::post('/create','TransactionController@create');

Route::get('/flush','TransactionController@session_end');

Route::get('/transactions/{id}','TransactionController@show');

Route::post('/delete/company','CompanyController@delete');

Route::get('/edit/company/{id}','CompanyController@edit');

Route::get('/create/company','CompanyController@create');

Route::post('/store/company','CompanyController@store');

Route::post('/update/company','CompanyController@update');  

Route::get('/admin','AdminController@dashboard');

Route::get('/team/{id}','TeamController@profile');

Route::get('/company/{id}','CompanyController@show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
