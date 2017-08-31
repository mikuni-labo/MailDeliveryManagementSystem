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
    Route::get( '/',       'HomeController@index')->name('home');
    Route::get( 'phpinfo', 'HomeController@phpinfo')->name('phpinfo');

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
        Route::get( '/',                'ListController@index')->name('visitor');
        Route::get( 'reset_search',     'ListController@reset')->name('visitor.search.reset');
        Route::get( 'add',              'StoreController@index')->name('visitor.add');
        Route::post('add',              'StoreController@store');
        Route::get( 'edit/{id}',        'EditController@index')->name('visitor.edit');
        Route::put( 'edit/{id}',        'EditController@update');
        Route::delete('delete/{id}',    'DeleteController@index')->name('visitor.delete');
        Route::patch( 'restore/{id}',   'RestoreController@index')->name('visitor.restore');

        Route::group([
            'prefix'     => 'csv',
            'namespace'  => 'Csv',
        ], function() {
            Route::get( '/',            'IndexController@index')->name('visitor.csv');
            Route::post('upload',       'UploadController@upload')->name('visitor.csv.upload');
            Route::get( 'download_sample', 'DownloadSampleController@index')->name('visitor.csv.download_sample');
        });
    });

    /**
     * メール配信管理
     */
    Route::group([
        'prefix'     => 'mail',
        'namespace'  => 'Mail',
    ], function() {
        Route::get( '/',                'ListController@index')->name('mail');
        Route::get( 'add',              'StoreController@index')->name('mail.add');
        Route::post('add',              'StoreController@store');
        Route::get( 'edit/{id}',        'EditController@index')->name('mail.edit');
        Route::put( 'edit/{id}',        'EditController@update');
        Route::delete('delete/{id}',    'DeleteController@index')->name('mail.delete');
        Route::patch( 'restore/{id}',   'RestoreController@index')->name('mail.restore');
    });
});

