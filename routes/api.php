<?php
$router = app('router');
$router->group([
    'prefix' => 'user',
    'middleware' => config('seo.middleware.api', ['auth']),
    'as' => 'api.',
], function () use ($router) {

});
