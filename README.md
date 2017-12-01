# Laravel hashed route

[![Build Status](https://travis-ci.org/markwalet/laravel-hashed-route.svg?branch=master)](https://travis-ci.org/markwalet/laravel-hashed-route)
[![Total Downloads](https://poser.pugx.org/markwalet/laravel-hashed-route/downloads)](https://packagist.org/packages/markwalet/laravel-hashed-route)
[![Latest Stable Version](https://poser.pugx.org/markwalet/laravel-hashed-route/v/stable)](https://packagist.org/packages/markwalet/laravel-hashed-route)
[![License](https://poser.pugx.org/markwalet/laravel-hashed-route/license)](https://packagist.org/packages/markwalet/laravel-hashed-route)

A Laravel package that replaces the default route model binding for a safer version.

## Installation
You can install this package with composer:

```shell
composer require markwalet/laravel-hashed-route
```

Laravel 5.5 uses Package auto-discovery, so you don't have to register the service provider. If you want to register the service provider manually, add the following line to your `config/app.php` file:

```php
MarkWalet\LaravelHashedRoute\HashedRouteServiceProvider::class
```

## Usage
When you want to hash the routes for a given model. The only thing you have to is is adding the `HasHashedRouteKey` trait:

```php
use MarkWalet\LaravelHashedRoute\Concerns\HasHashedRouteKey;

class TestModel extends Model
{
    use HasHashedRouteKey;
    
    //...
}
```

After that you can use the model like you normally would. When using the `route()` or `action()` helper method you can just use the model itself as a parameter. When you want to manually construct the url, you can use the `hashed_key` property that is appended on the model.

## Configuration
The default configuration is defined in `hashed-route.php`. If you want to edit this file you can copy it to your config folder by using the following command:
```shell
php artisan vendor:publish --provider="MarkWalet\LaravelHashedRoute\HashedRouteServiceProvider"
```

In this file you can configure different codecs for the encoding and decoding of keys, as well as setting a default configuration.

You can override this configuration by setting the `codec` property on your model.

The supported codec drivers are: `null`, `hashids`, `optimus` & `base64`. Use the `null` driver if you want to disable route key hashing.