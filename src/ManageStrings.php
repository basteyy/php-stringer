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
 * @param string $string
 * @return string
 */
function escapeString(string $string): string
{
    return htmlspecialchars($string);
}

/**
 * @param string $string
 * @param string $algorithm
 * @return string
 */
function getStringHashSum(
    string $string,
    string $algorithm = 'sha256'): string
{
    return hash($algorithm, $string);
}

/**
 * Remove double slashed from a string
 * @param string $path
 * @return string
 */
function remove_double_slashes(string $path): string
{
    return str_replace('//', '/', $path);
}

/**
 * Convert a string into a url optimized version
 * @param string $text
 * @param string $divider
 * @param string $empty_default_text
 * @return string
 */
function getSlugifiedText(string $text, string $divider = '-', string $empty_default_text = 'n-a'): string
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    if ('' === $text) {
        return $empty_default_text;
    }

    // lowercase
    $text = strtolower($text);

    return $text;
}

/**
 * @param string $text
 * @param string $divider
 * @return string
 * @deprecated Use getSlugifiedText
 */
function slugify(string $text, string $divider = '-'): string
{
    return getSlugifiedText($text, $divider);
}