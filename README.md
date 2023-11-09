# basteyy`s PHP Stringer Package

Every developer knows the drill: Here I need a random string, there I have to generate a URL from an input, and then I want to find out how long ago an event was. This package bundles a few functions that I constantly need in my projects. You are welcome to contribute and expand it.

## Installation

```bash
composer require basteyy/php-stringer
```

## Usage

To use the `basteyy\php-stringer` package in your projects, here are some examples with their expected outputs:

### String Mainiplation

#### Escape String
For safe output of strings in an HTML context, use `escapeString`:
```php
echo basteyy\Stringer\escapeString('<script>alert("hello")</script>');
// Output: &lt;script&gt;alert(&quot;hello&quot;)&lt;/script&gt;
```

#### Generate Hash Sum
Create a hash sum of a string (default algorithm is SHA256) using `getStringHashSum`:
```php
echo basteyy\Stringer\getStringHashSum('yourStringHere');
// Output: [sha256 hash of 'yourStringHere']
```
#### Remove Double Slashes
Use `remove_double_slashes` to clean up file paths or URLs:
```php
echo basteyy\Stringer\remove_double_slashes('https://example.com//path//');
// Output: https://example.com/path/
```
#### Slugify Text
Convert a string into a URL-optimized version with `getSlugifiedText`:
```php
echo basteyy\Stringer\getSlugifiedText('Hello World! How are you?');
// Output: hello-world-how-are-you
```
##### Slugify (Deprecated)
For backward compatibility, `slugify` is still available but is deprecated. It functions the same as `getSlugifiedText`:
```php
echo basteyy\Stringer\slugify('This is a Test String!');
// Output: this-is-a-test-string
```

### Random String Generation
#### Generate Alphanumeric String
```php
echo basteyy\Stringer\getRandomAlphaNumericString(10);
// Output example: "1a2b3c4d5e"
```
#### Generate Numeric String
```php
echo basteyy\Stringer\getRandomNumericString(10);
// Output example: "1234567890"
```
#### Generate Alphabet String
```php
echo basteyy\Stringer\getRandomAlphaString(10);
// Output example: "aBcDeFgHiJ"
```
#### Generate String with Custom Characters:
```php
echo basteyy\Stringer\getRandomString(10, '!@#$%^&*()');
// Output example: "%$@!^&*!@"
```
#### Create memorable password
The createMemorablePassword function in the basteyy\Stringer library generates passwords that are easier to remember, combining words, numbers, and symbols. This function is not cryptographically secure and is more suitable for user-friendly passwords rather than high-security purposes.
```php
$password = basteyy\Stringer\createMemorablePassword(2, 2, 2, true);
echo $password;
```

In this example, the function generates a password with:

* 2 random words from a predefined list.
* 2 random numbers.
* 2 random symbols from the default symbol set !@#$%^&*.
* Converts the password to lowercase.

The output will be a string like `apple7%cloud4*`, making it memorable yet unique. You can adjust the counts of words, numbers, and symbols as needed.

> Attention: The function `createMemorablePassword` is not cryptographically secure and should not be used for high-security.

### Time Manipulation

#### Get Nice Time Ago

`getNiceTimeAgo` function returns a human-readable time difference from the current time to the provided DateTime.

```php
// Standard usage with default unit names
echo basteyy\Stringer\Times\getNiceTimeAgo('2023-01-01 00:00:00');
// Output example: "2 months ago"

// Exact output
echo basteyy\Stringer\Times\getNiceTimeAgo('2023-01-01 00:00:00', true);
// Output example: "2 months, 3 days, 4 hours, 5 minutes, 6 seconds ago"

// Custom unit names
$customUnitMap = [
    'second' => ['Sekunde', 'Sekunden'],
    'minute' => ['Minute', 'Minuten'],
    // ... other units
];
echo basteyy\Stringer\Times\getNiceTimeAgo('2023-01-01 00:00:00', false, $customUnitMap);
// Output example: "2 Monate ago"
```
These examples showcase the versatility of the `getNiceTimeAgo` function, providing options for exact time intervals, custom unit names, and localization.