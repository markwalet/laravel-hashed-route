![Laravel hashed route](https://banners.beyondco.de/Laravel%20hashed%20route.png?theme=light&packageName=markwalet%2Flaravel-hashed-route&pattern=circuitBoard&style=style_1&description=A+Laravel+package+that+replaces+the+default+route+model+binding+for+a+safer+version.&md=0&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg&widths=200&heights=auto)

[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Stable Version](https://poser.pugx.org/markwalet/laravel-hashed-route/v/stable)](https://packagist.org/packages/markwalet/laravel-hashed-route)
[![Build status](https://img.shields.io/github/workflow/status/markwalet/laravel-hashed-route/tests?style=flat-square&label=tests)](https://github.com/markwalet/laravel-hashed-route/actions)
[![Coverage](https://codecov.io/gh/markwalet/laravel-hashed-route/branch/master/graph/badge.svg)](https://codecov.io/gh/markwalet/laravel-hashed-route)
[![StyleCI](https://github.styleci.io/repos/112489141/shield?branch=master)](https://github.styleci.io/repos/112489141)
[![Total Downloads](https://poser.pugx.org/markwalet/laravel-hashed-route/downloads)](https://packagist.org/packages/markwalet/laravel-hashed-route)

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

After that you can use the model like you normally would. Because the trait overrides the `resolveRouteBinding()` and `getRouteKey()` methods, no extra changes are required to your code.

You do have to change your code when you are building your urls by manually getting the `$model->id` property from your model. Then you will have to change those calls to `$model->getRouteKey()`.

## Configuration
The default configuration is defined in `hashed-route.php`. If you want to edit this file you can copy it to your config folder by using the following command:
```shell
php artisan vendor:publish --provider="MarkWalet\LaravelHashedRoute\HashedRouteServiceProvider"
```

In this file you can configure different codecs for the encoding and decoding of keys, as well as setting a default configuration.

You can override this configuration by setting the `codec` property on your model.

The supported codec drivers are: `null`, `hashids`, `optimus` & `base64`. Use the `null` driver if you want to disable route key hashing.
