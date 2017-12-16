<?php
Route::group(['prefix' => 'seo', 'as' => 'seo::', 'namespace' => '\SEO\Http\Controllers'], function () {

    Route::resource('pages', 'PageController');
    Route::resource('meta-tags', 'MetaTagController');
    Route::resource('settings', 'SettingController', ['only' => ['index', 'edit', 'update']]);

});
