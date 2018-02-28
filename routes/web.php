<?php
Route::group([
    'prefix' => 'seo', 'as' => 'seo::',
    'middleware' => ['web', config('seo.middleware', 'auth')],
    'namespace' => '\SEO\Http\Controllers'], function () {
    Route::get('analysis', ['uses' => 'AnalysisController@index', 'analysis.index']);
    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);
    Route::get('dashboard/social', ['uses' => 'DashboardController@social', 'as' => 'dashboard.social']);
    Route::get('dashboard/sitemap', ['uses' => 'DashboardController@sitemap', 'as' => 'dashboard.sitemap']);
    Route::get('dashboard/tools', ['uses' => 'DashboardController@tools', 'as' => 'dashboard.tools']);
    Route::get('dashboard/advanced', ['uses' => 'DashboardController@advanced', 'as' => 'dashboard.advanced']);

    Route::resource('pages.images', 'ImageController', ['except' => ['show'], 'parameters' => [
        'images' => 'pageImage'
    ]]);

    Route::get('pages/bulk-edit', ['uses' => 'PageController@bulkEdit', 'as' => 'pages.bulkEdit']);
    Route::post('pages/bulk-update', ['uses' => 'PageController@bulkUpdate', 'as' => 'pages.bulkUpdate']);

    Route::post('pages/cache', ['uses' => 'PageController@cache', 'as' => 'pages.cache']);

    Route::post('pages/upload', ['uses' => 'PageController@upload', 'as' => 'pages.upload']);

    Route::get('pages/download-zip', ['uses' => 'PageController@zip', 'as' => 'pages.zip']);

    Route::get('pages/download', ['uses' => 'PageController@download', 'as' => 'pages.download']);

    Route::get('pages/meta/{page}', ['uses' => 'PageController@meta', 'as' => 'pages.meta']);

    Route::post('pages/meta/{page}', ['uses' => 'PageController@saveMeta', 'as' => 'pages.meta.save']);

    Route::get('pages/generate', ['uses' => 'PageController@generate', 'as' => 'pages.generate']);

    Route::resource('pages', 'PageController');

    Route::post('meta-tags/global', ['uses' => 'MetaTagController@global', 'as' => 'meta-tags.global']);

    Route::resource('meta-tags', 'MetaTagController');

    Route::post('settings/robot-txt', ['uses' => 'SettingController@robotTxt', 'as' => 'settings.robot_txt']);
    Route::post('settings/htaccess', ['uses' => 'SettingController@htaccess', 'as' => 'settings.htaccess']);

    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);

    Route::post('sitemap/update', ['uses' => 'SiteMapController@update', 'as' => 'sitemap.update']);
    Route::post('sitemap/generate', ['uses' => 'SiteMapController@store', 'as' => 'sitemap.generate']);
});
