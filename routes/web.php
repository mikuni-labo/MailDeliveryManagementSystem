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

Route::group([], function() {
    Route::get( '/',       'HomeController@index')->name('home');
    Route::get( 'phpinfo', 'HomeController@phpinfo')->name('phpinfo');

    /**
     * Auth
     */
    Auth::routes();

    Route::group([
        'namespace'  => 'Auth',
    ], function() {
        Route::get( 'modify',   'ModifyController@index')->name('modify');
        Route::put( 'modify',   'ModifyController@update');
    });

    /**
     * Visitors
     */
    Route::group([
        'prefix'     => 'visitor',
        'namespace'  => 'Visitor',
    ], function() {
        Route::get( '/',                'ListController@index')->name('visitor');
        Route::get( 'reset',            'ListController@reset')->name('visitor.reset');
        Route::get( 'add',              'StoreController@index')->name('visitor.add');
        Route::post('add',              'StoreController@store');
        Route::get( '{id}/edit',        'EditController@index')->name('visitor.edit');
        Route::put( '{id}/edit',        'EditController@update');
        Route::delete('{id}/delete',    'DeleteController@delete')->name('visitor.delete');
        Route::patch( '{id}/restore',   'RestoreController@restore')->name('visitor.restore');
        Route::get( '{id}/log',         'LogListController@index')->name('visitor.log');

        Route::group([
            'prefix'     => 'csv',
            'namespace'  => 'Csv',
        ], function() {
            Route::get( '/',               'IndexController@index')->name('visitor.csv');
            Route::post('upload',          'UploadController@upload')->name('visitor.csv.upload');
            Route::get( 'download_sample', 'DownloadSampleController@download')->name('visitor.csv.download_sample');
        });
    });

    /**
     * Mails
     */
    Route::group([
        'prefix'     => 'mail',
        'namespace'  => 'Mail',
    ], function() {
        Route::get( '/',                'ListController@index')->name('mail');
        Route::get( 'add',              'StoreController@index')->name('mail.add');
        Route::post('add',              'StoreController@store');
        Route::get( '{id}/edit',        'EditController@index')->name('mail.edit');
        Route::put( '{id}/edit',        'EditController@update');
        Route::delete('{id}/delete',    'DeleteController@delete')->name('mail.delete');
        Route::patch( '{id}/restore',   'RestoreController@restore')->name('mail.restore');

        Route::group([
            'prefix'     => 'log',
            'namespace'  => 'Log',
        ], function() {
            Route::get( '/',            'ListController@index')->name('mail.log');
            Route::get( '{id}/visitor', 'VisitorListController@index')->name('mail.log.visitor');
        });

        Route::group([
            'prefix'     => '{id}/set',
            'namespace'  => 'Set',
        ], function() {
            Route::get( '/',                     'ListController@index')->name('mail.set');
            Route::get( 'add',                   'StoreController@index')->name('mail.set.add');
            Route::post('add',                   'StoreController@store');
            Route::get( '{setId}/edit',          'EditController@index')->name('mail.set.edit');
            Route::put( '{setId}/edit',          'EditController@update');
            Route::delete('{setId}/delete',      'DeleteController@delete')->name('mail.set.delete');
            Route::patch( '{setId}/restore',     'RestoreController@restore')->name('mail.set.restore');
            Route::get( '{setId}/visitor',       'VisitorsSetController@index')->name('mail.set.visitor');
            Route::get( '{setId}/visitor/reset', 'VisitorsSetController@reset')->name('mail.set.visitor.reset');
            Route::put( '{setId}/visitor/ajax',  'VisitorsSetController@ajax');
            Route::post('{setId}/delivery',      'DeliveryController@delivery')->name('mail.set.delivery');
        });
    });

    /**
     * Tests
     */
    Route::group([
        'prefix'     => 'test',
    ], function() {
        Route::get( '/',                 'TestController@index')->name('test');
        Route::get( 'facade_mail',       'TestController@sendTestMailViaFacade')->name('test.mail.facade');
        Route::get( 'notification_mail', 'TestController@sendTestMailViaNotification')->name('test.mail.notification');
    });
});

