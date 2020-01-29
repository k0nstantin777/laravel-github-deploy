# Laravel GitHub Deploy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/konstantinn/laravel-github-deploy?style=flat-square)](https://packagist.org/packages/konstantinn/laravel-github-deploy)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/konstantinn/laravel-github-deploy?style=flat-square)](https://packagist.org/packages/konstantinn/laravel-github-deploy)


## About

This package allows you to automate the publication of updates to your server, after publishing them to Github.

## Install

```bash
composer require konstantinn/laravel-github-deploy
 ```

Go to your remote server and set url git origin repository with user and pass:

```bash 
git remote set-url origin https://USERNAME:PASSWORD@github.com/USERNAME/REPOSITORY.git
```

Publish config file deploy.php

```bach
php artisan vendor:publish --provider="Konstantinn\LaravelGitHubDeploy\DeployServiceProvider"
```

By default, the log is written to the file storage/logs/deploy.log, but you can change the path in the config file deploy.php

Open VerifyCsrfToken middleware and add route '/deploy' to except protected property:

```php

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/deploy'
    ];
}
```

Go to your GitHub repository and create webhook with Payload Url: https://SITE.DOMEN/deploy  
Fill Secret field and copy this data and paste in .env file:
 
 ```
 APP_DEPLOY_SECRET=GIH_HUB_HOOK_SECRET  
 ```  
 
 Check request webhook in Recent Deliver part.
 
 Whats all!
 
### Deploy Сommands
By default deploy runs next commands:

```php
'commands' => [
    'git pull',
    'composer install --no-interaction --no-dev --prefer-dist',
    'php artisan migrate --force',
],
```

But you can add or modify commands in config file deploy.php.

### Contributors

 * [@k0nstantin777](https://github.com/k0nstantin777) the original author of this package.

