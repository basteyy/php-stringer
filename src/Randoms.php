<?php
/**
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @website https://github.com/basteyy
 * @website https://eiweleit.de
 */

declare(strict_types=1);

namespace basteyy\Stringer;

use Exception;

/**
 * Returns a random string with alphanumeric characters.
 * @param int $length
 * @return string
 * @throws Exception
 */
function getRandomAlphaNumericString(
    int $length = 32): string
{
    return getRandomString($length, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
}

/**
 * Returns a random string with numeric characters.
 * @param int $length
 * @return string
 * @throws Exception
 */
function getRandomNumericString(
    int $length = 32): string
{
    return getRandomString($length, '0123456789');
}

/**
 * Returns a random string with alpha characters.
 * @param int $length
 * @return string
 * @throws Exception
 */
function getRandomAlphaString(
    int $length = 32): string
{
    return getRandomString($length, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
}

/**
 * Returns a random string with special characters.
 * @param int $length
 * @param string $characters
 * @return string
 * @throws Exception
 */
function getRandomString(
    int    $length = 32,
    string $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,.-#*!"§$%&/()=?`´+~;:_<>[]{}|^@'): string
{
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
