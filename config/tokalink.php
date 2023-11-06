<?php

return [
    'app_name' => env('APP_NAME', 'CEKDPT'),
    'admin_prefix' => env('ADMIN_PREFIX_URL', 'admin'),
    'theme' => env('THEME_ADMIN', 'theme1'),
    'logo_web' => "/assets-admin/theme2/img/logo.png",
    'facebook_login' => env('FACEBOOK_LOGIN', false),
    'google_login' => env('GOOGLE_LOGIN', false),
    'twitter_login' => env('TWITTER_LOGIN', false),
    'menu' => [
        'Main' => [
            'icon' => 'fas fa-cart-plus',
            'route' => 'order',
            'permission' => 'master',
            'child' => [],
        ],
        'Data' => [
            'icon' => 'fa fa-database',
            'route' => '',
            'permission' => 'master',
            'child' => [
                'Data Dpt' => [
                    'icon' => 'fa fa-users',
                    'route' => 'cekdpt',
                    'permission' => 'cekdpt',
                    'child' => []
                ],
                'User' => [
                    'icon' => 'fa fa-book',
                    'route' => 'users',
                    'permission' => 'users',
                    'child' => []
                ],
            ]
        ],
    ]
];
