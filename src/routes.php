<?php 

Route::group(['prefix' => 'sitemap','namespace' => '\Megaads\Generatesitemap\Controllers'], function() {
    Route::get('/generator', 'GeneratorController@generator');
});