<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

        'public-image-league' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/league/',
            'url' => env('APP_URL') . '/images/upload/league/',
            'visibility' => 'public',
            'throw' => false,
        ],


        'public-image-post' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/post/',
            'url' => env('APP_URL') . '/images/upload/post/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-image-category' => [
            'driver' => 'local',
            'root' => public_path() . '/images/exchange/category/',
            'url' => env('APP_URL') . '/images/exchange/category/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-image-team' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/team/',
            'url' => env('APP_URL') . '/images/upload/team/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-image-group' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/group/',
            'url' => env('APP_URL') . '/images/upload/group/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-image-user' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/user/',
            'url' => env('APP_URL') . '/images/upload/user/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-avatar-partner' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/partner/',
            'url' => env('APP_URL') . '/images/upload/partner/',
            'visibility' => 'public',
            'throw' => false,
        ],

        'public-image-product' => [
            'driver' => 'local',
            'root' => public_path() . '/images/upload/product/',
            'url' => env('APP_URL') . '/images/upload/product/',
            'visibility' => 'public',
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
