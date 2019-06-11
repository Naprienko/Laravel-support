<?php
Route::group([
    'namespace' =>  '\Ingvar\Support\Controllers',
    'as' => 'ingvar.support.',
    'middleware' => ['web'],
], function () {
    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | USERPANEL
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'userpanel/support/tickets',  'middleware' => ['web','auth']],function (){
        Route::get('/', 'TicketsController@user_index')->name('tickets.user_index');
        Route::get('create', 'TicketsController@user_create')->name('tickets.user_create');
        Route::post('/', 'TicketsController@user_store')->name('tickets.user_store');
        Route::get('/{id}/edit', 'TicketsController@user_edit')->name('tickets.user_edit');
        Route::put('/{id}', 'TicketsController@user_update')->name('tickets.user_update');
        Route::delete('/{id}', 'TicketsController@user_destroy')->name('tickets.user_destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMINPANEL
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin/support',  'middleware' => ['web','auth','onlyadmin']],function (){
        Route::resource('tickets', 'TicketsController');
    });

});