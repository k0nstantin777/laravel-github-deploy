<?php

return [
    /*
     * Github deploy config
     */

    'deploy_secret' => env('APP_DEPLOY_SECRET'),

    'deploy_log_file' => storage_path('logs/deploy.log'),

    'commands' => [
        'git pull',
        'composer install --no-interaction --no-dev --prefer-dist',
        'php artisan migrate --force',
    ],
];