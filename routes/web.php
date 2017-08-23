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
        Route::put( 'modify',   'ModifyController@update');
    });

    /**
     * 来場者管理
     */
    Route::group([
        'prefix'     => 'visitor',
        'namespace'  => 'Visitor',
    ], function() {
        Route::get( '/',          'ListController@index')->name('visitor');

        Route::get( 'add',        'StoreController@index')->name('visitor.add');
        Route::post('add',        'StoreController@store');

//         Route::get( 'edit{id}',   'EditController@index')->name('visitor.edit');
//         Route::post('edit{id}',   'EditController@update');
    });

    /**
     * メール配信管理
     */
    Route::group([
        'prefix'     => 'mail',
        'namespace'  => 'Mail',
    ], function() {
        Route::get( '/',          'ListController@index')->name('mail');

        Route::get( 'add',        'StoreController@index')->name('mail.add');
        Route::post('add',        'StoreController@store');

//         Route::get( 'edit{id}',   'ModifyController@index')->name('mail.edit');
//         Route::post('edit{id}',   'ModifyController@update');
    });
});

