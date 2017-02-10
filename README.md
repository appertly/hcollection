# hcollection

This library can be used by projects which either wish to use an API compatible with Hack collections, or by projects which are being converted from Hack into PHP. It should basically be a drop-in replacement.

[![Packagist](https://img.shields.io/packagist/v/appertly/hcollection.svg)](https://packagist.org/packages/appertly/hcollection)

## Installation

You can install this library using Composer:

```console
$ composer require appertly/hcollection
```

* The master branch (version 1.x) of this project requires PHP 7.1 and has no dependencies.

## Compliance

Releases of this library will conform to [Semantic Versioning](http://semver.org).

Our code is intended to *mostly* comply with [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/). If you find any issues related to standards compliance, please send a pull request!

## License

Just like the upstream Hack project, this project is licensed under the 3-clause BSD license.

## Gotchas

As of PHP 7.1, the name `iterable` is now a reserved word. This causes problems with the `HH\Iterable` interface. In this library, this interface has been renamed to `HH\HackIterable`.

We have also added `JsonSerializable` to all concrete classes.

Since PHP wouldn't be able to support curly-brace instantiation, (e.g. `Vector{1,2,3}`), we instead added a (Google Guava-style) static `of` method to all the concrete classes:

```php
use HH\ImmMap;
use HH\ImmVector;

$map = ImmMap::of(); // would be empty
$vector = ImmVector::of(); // would be empty
$map = ImmMap::of('key1', 'value1', 'key2', 'value2', 'key3'); // value3 would be null
$vector = ImmVector::of(1, 2, 3);
```
