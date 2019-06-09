<?php

include_route_files(__DIR__.'/frontend/');

Route::get('/', 'HomeController@index')->name('index');
