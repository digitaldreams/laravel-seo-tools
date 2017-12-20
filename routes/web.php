<?php
Route::group(['prefix' => 'seo', 'as' => 'seo::', 'middleware' => ['web', config('seo.middleware', 'auth')], 'namespace' => '\SEO\Http\Controllers'], function () {

    Route::get('pages/generate', ['uses' => 'PageController@generate', 'as' => 'pages.generate']);
    Route::resource('pages', 'PageController');
    Route::resource('meta-tags', 'MetaTagController');
    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);

});
