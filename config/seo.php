<?php
return [
    /**
     * Layout's to be used on package pages
     */
    'layout' => 'permit::layouts.app',
    /**
     * Middleware that will wrap up seo routes
     */
    'middleware' => 'auth',
    /**
     *
     */
    'linkProviders' => [

    ],
    /**
     * Name of the flash variable that holds success message
     */
    'flash_message' => 'permit_message',

    /**
     * Name of the flash variable that holds error message
     */
    'flash_error' => 'permit_error'
];