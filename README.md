# basteyy`s PHP Stringer Package

Every developer knows the drill: Here I need a random string, there I have to generate a URL from an input, and then I want to find out how long ago an event was. This package bundles a few functions that I constantly need in my projects. You are welcome to contribute and expand it.

## Installation

```bash
composer require basteyy/php-stringer
```

## Usage

```php
// Get random string
$randomString = \basteyy\Stringer::getRandomString(10);
```
