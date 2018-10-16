<?php
return [
    /**
     * Layout's to be used on package pages
     */
    'layout' => 'seo::layouts.app',
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
    'flash_error' => 'permit_error',

    /**
     * Full path where robot.txt file will be saved.
     */
    'robot_txt' => public_path('robots.txt'),

    /**
     * Full path where .htaccess file will be saved.
     */
    'htaccess' => public_path('.htaccess'),

    /**
     * public folder of your xml sitemap
     */
    'sitemap_location' => 'sitemaps',

    /**
     * Cache setting
     */
    'cache' => [
        /**
         * Do you like to serve seo tags from cache. It is highly recommended on production server.
         */
        'enable' => true,

        /**
         * Path where html files will be saved.
         */
        'storage' => storage_path('app/seo'),

        /**
         * After a this time cache will be update with database.
         *
         * Expire in seconds. Default it would be one hour
         */
        'expire' => 3600
    ],

    /**
     * Image Storage
     */
    'storage' => [

        /**
         * Storage driver
         */
        'driver' => 'public',

        /**
         * Prefix which will be used before every image url
         */
        'prefix' => 'storage',

        /**
         * Which folder on your driver will storage all the files
         */
        'folder' => 'seo'
    ],
    'models' => [

    ],
];