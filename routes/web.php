<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('Home');

Auth::routes();
Route::post('register', 'Auth\RegisterController@register')->middleware('maxadmin');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/logs', 'DashboardController@logs')->name('Error Logs');

Route::get('/dashboard/settings', 'SettingController@index')->name('settings');

Route::get('/dashboard/wallet', 'WalletController@dashboard')->name('wallet');

Route::post('/dashboard/settings', 'SettingController@update');

Route::get('/dashboard/transaction/{id}', 'DashboardController@transaction')->name('transaction details');

Route::get('dashboard/api_token', 'DashboardController@api_token');

Route::get('documentation', 'ApiDocsController@index')->name('API Documentation');

Route::get('dashboard/demo', 'DemoController@demonstration');
Route::post('dashboard/demo/test', 'DemoController@testTransaction');
