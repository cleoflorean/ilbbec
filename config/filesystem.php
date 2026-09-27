<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan disk default yang akan digunakan oleh
    | framework. Disk 'local' serta disk 'public' dan 's3' tersedia.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Di bawah ini Anda dapat mengkonfigurasi disk sebanyak yang dibutuhkan.
    | Anda bahkan dapat mengkonfigurasi beberapa disk dari driver yang sama.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
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
            'throw' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Google Drive Disk Configuration
        |--------------------------------------------------------------------------
        |
        | Menggunakan package masbug/flysystem-google-drive-ext.
        | Pengaturan OAuth2 atau Service Account diambil dari file .env.
        |
        */
        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folder' => env('GOOGLE_DRIVE_FOLDER_ID'), // Target Folder ID di Google Drive
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan tautan simbolis yang akan dibuat saat
    | perintah Artisan `storage:link` dijalankan.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];