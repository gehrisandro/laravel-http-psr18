<p align="center">
    <p align="center">
        <a href="https://github.com/gehrisandro/laravel-http-psr18/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/gehrisandro/laravel-http-psr18/tests.yml?branch=main&label=tests&style=round-square"></a>
        <a href="https://packagist.org/packages/gehrisandro/laravel-http-psr18"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/gehrisandro/laravel-http-psr18"></a>
        <a href="https://packagist.org/packages/gehrisandro/laravel-http-psr18"><img alt="Latest Version" src="https://img.shields.io/packagist/v/gehrisandro/laravel-http-psr18"></a>
        <a href="https://packagist.org/packages/gehrisandro/laravel-http-psr18"><img alt="License" src="https://img.shields.io/github/license/gehrisandro/laravel-http-psr18"></a>
    </p>
</p>

------

# PSR-18 compatible HTTP Client for Laravel

This package provides a [PSR-18](https://www.php-fig.org/psr/psr-18/) compatible wrapper for the [Laravel HTTP Client](https://laravel.com/docs/10.x/http-client).

This can be helpful if you want to use the Laravel HTTP Client in a package requiring a PSR-18 compatible HTTP Client.

If you find this package helpful, please consider sponsoring the maintainer:
- Sandro Gehri: **[github.com/sponsors/gehrisandro](https://github.com/sponsors/gehrisandro)**

## Table of Contents
- [Get Started](#get-started)
- [Usage](#usage)
- [Contributing](#contributing)

## Get Started

> **Requires [Laravel 10](https://github.com/laravel/laravel)** (or at lease the `illuminate/http` package)

First, install the package via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require gehrisandro/laravel-http-psr18
```

Then, use the `HttpPsr18::make()` method to create a new instance of the PSR-18 compatible HTTP Client.

## Usage

If you call the `make()` method without any arguments, the default Laravel HTTP Client will be used:

```php
use HttpPsr18\HttpPsr18;

$client = HttpPsr18::make();

// example usage with OpenAI for Laravel (https://github.com/openai-php/laravel)
$openAI = \OpenAI::factory()
    ->withApiKey('*******')
    ->withHttpClient($client)
    ->make();

$response = $openAI->chat()->create([/* ... */]);
```

You can provide a custom Laravel HTTP Client instance as the first argument:

```php
use HttpPsr18\HttpPsr18;
use Illuminate\Support\Facades\Http;

$client = HttpPsr18::make(Http::timeout(300));
```

With this package you get a PSR-18 compatible HTTP Client and you can make use of all the Laravel HTTP Client features. 🥳

```php
use GuzzleHttp\Psr7\Request;
use HttpPsr18\HttpPsr18;
use Illuminate\Support\Facades\Http;

Http::fake([
    '*' => Http::response('Hello World'),
]);

$client = HttpPsr18::make();

$response = $client->sendRequest(new Request('GET', 'https://example.com'));

$response->getBody()->getContents(); // Hello World
```

## Contributing

Thank you for considering contributing to `LaravelHttpPsr18`! The contribution guide can be found in the [CONTRIBUTING.md](CONTRIBUTING.md) file.

---

LaravelHttpPsr18 is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
