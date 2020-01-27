<?php

return [
    /*
     * Github deploy config
     */

    'github_deploy_huk_id' => env('GITHUB_DEPLOY_HUKID'),

    'deploy_secret' => env('APP_DEPLOY_SECRET'),

    'deploy_log_file' => storage_path('logs/deploy.log'),

    'commands' => [
        'git pull',
        'composer install --no-interaction --no-dev --prefer-dist',
        'php artisan migrate --force',
    ],
];