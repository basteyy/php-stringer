# Get and clean strings

Yep, you know the struggle: there a new password, here a new private numeric string and again and again you have to clean it up. This package helps you to get rid of the hassle. 

>
> Attention: This package is for PHP 8.3 and above. But it should work under PHP 8.1 and above too. But to be honest, I didn't test it and you should update to PHP 8.3 anyway.
> 

## Installation

```bash
composer require basteyy/php-stringer
```

## Usage

```php
// Get random string
$randomString = \basteyy\Stringer::getRandomString(10);
```
