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

Route::match(['get', 'post'], '/', [
    'as' => 'auth',
    'uses' => 'AuthController@auth'
]);

Route::group(['middleware' => 'checkUser'], function () {

    Route::get('/account', [
        'as' => 'account',
        'uses' => 'Account\TodoController@todoList'
    ]);

    Route::post('/create-task', [
        'as' => 'create-task',
        'uses' => 'Account\TodoController@createTask'
    ]);

    Route::get('/change-status-task', [
        'as' => 'change-status-task',
        'uses' => 'Account\TodoController@changeStatusTask'
    ]);

    Route::get('/remove-task', [
        'as' => 'remove-task',
        'uses' => 'Account\TodoController@removeTask'
    ]);

});

