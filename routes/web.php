<?php
Route::group([
    'prefix' => 'seo', 'as' => 'seo::',
    'middleware' => ['web', config('seo.middleware', 'auth')],
    'namespace' => '\SEO\Http\Controllers'], function () {

    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);

    Route::resource('pages.images', 'ImageController', ['except' => ['show'], 'parameters' => [
        'images' => 'pageImage'
    ]]);

    Route::post('pages/upload', ['uses' => 'PageController@upload', 'as' => 'pages.upload']);

    Route::get('pages/download', ['uses' => 'PageController@download', 'as' => 'pages.download']);

    Route::get('pages/meta/{page}', ['uses' => 'PageController@meta', 'as' => 'pages.meta']);

    Route::post('pages/meta/{page}', ['uses' => 'PageController@saveMeta', 'as' => 'pages.meta.save']);

    Route::get('pages/generate', ['uses' => 'PageController@generate', 'as' => 'pages.generate']);

    Route::resource('pages', 'PageController');

    Route::post('meta-tags/global', ['uses' => 'MetaTagController@global', 'as' => 'meta-tags.global']);

    Route::resource('meta-tags', 'MetaTagController');

    Route::post('settings/robot-txt', ['uses' => 'SettingController@robotTxt', 'as' => 'settings.robot_txt']);

    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);

});
