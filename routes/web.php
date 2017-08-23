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

Route::group([
    'middleware' => [
        'web',
    ],
], function() {
    Route::get( '/', 'HomeController@index')->name('home');

    /**
     * 認証
     */
    Auth::routes();

    Route::group([
        'prefix'     => '',
        'namespace'  => 'Auth',
    ], function() {
        Route::get( 'modify',   'ModifyController@index')->name('modify');
        Route::post('modify',   'ModifyController@update');
    });

    /**
     * 来場者管理
     */
//     Route::group([
//         'prefix'     => 'visitor',
//         'namespace'  => 'Visitor',
//     ], function() {
//
//     });

    /**
     * メール配信管理
     */
    Route::group([
        'prefix'     => 'mail',
        'namespace'  => 'Mail',
    ], function() {
        Route::get( 'add',    'StoreController@index')->name('mail.add');
        Route::post('add',    'StoreController@store');

        Route::get( 'edit',   'ModifyController@index')->name('mail.edit');
        Route::post('edit',   'ModifyController@update');
    });
});

