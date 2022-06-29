<?php
return [
    /**
     * Layout's to be used on package pages
     */
    'layout' => 'seo::layouts.app',

    /**
     * Middleware that will wrap up seo routes
     */
    'middleware' => [
        'web' => ['web','auth'],
        'api' => ['auth:sanctum'],
    ],

    /**
     *
     */
    'linkProviders' => [

    ],
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
         * file or database
         */
        'driver' => 'file',
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
        'expire' => 3600,
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
        'folder' => 'seo',
    ],
    'models' => [

    ],
];
