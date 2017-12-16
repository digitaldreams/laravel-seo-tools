<?php
Route::group(['prefix' => 'seo', 'as' => 'seo::','middleware'=>['web'], 'namespace' => '\SEO\Http\Controllers'], function () {

    Route::resource('pages', 'PageController');
    Route::resource('meta-tags', 'MetaTagController');
    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);

});
