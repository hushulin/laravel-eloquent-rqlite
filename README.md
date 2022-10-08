# larevel eloquent for rqlite

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hushulin/laravel-eloquent-rqlite.svg?style=flat-square)](https://packagist.org/packages/hushulin/laravel-eloquent-rqlite)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/hushulin/laravel-eloquent-rqlite/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/hushulin/laravel-eloquent-rqlite/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hushulin/laravel-eloquent-rqlite.svg?style=flat-square)](https://packagist.org/packages/hushulin/laravel-eloquent-rqlite)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require hushulin/laravel-eloquent-rqlite
```

lumen framework add below to bootstrap/app.php
```php
$app->register(Hushulin\LaravelEloquentRqlite\LaravelEloquentRqliteServiceProvider::class); 
```

lumen framework add config to config/database.php
```php 
'connections' => [
        
        'rqlite' => [
            'driver' => 'rqlite',
            'host' => '',
            'database' => ':memory:',
            'username' => '',
            'password' => '',
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => env('DB_PREFIX', ''),
        ],
        // ...
   ]
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-eloquent-rqlite-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-eloquent-rqlite-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-eloquent-rqlite-views"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [hushulin](https://github.com/hushulin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
