<?php


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
], function() {

    include_route_files(__DIR__.'/frontend/');

    Route::get('/', 'HomeController@index')->name('index');

});
