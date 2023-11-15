<?php
/**
 * @author basteyy <sebastian@xzit.email>
 * @website https://github.com/basteyy
 * @website https://xzit.online
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
function getSlugifiedText(string $text,
                          string $divider = '-',
                          string $empty_default_text = 'n-a'): string
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // Check if iconv is installed
    if (function_exists('iconv')) {
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

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

/**
 * Function creates a random password which should be easy to remember. Be aware that this function is not cryptographically secure.
 * @param int $wordCount
 * @param int $numberCount
 * @param int $symbolCount
 * @param bool $lowercase
 * @param array|null $words
 * @param string|null $symbols
 * @return string
 */
function createMemorablePassword(int     $wordCount = 2,
                                 int     $numberCount = 2,
                                 int     $symbolCount = 2,
                                 bool    $lowercase = false,
                                 ?array  $words = [],
                                 ?string $symbols = '!@#$%^&*'): string
{
    if (empty($words)) {
        $words = [
            "Apple", "Blue", "Cloud", "Dream", "Earth", "Flower", "Garden", "Harbor", "Island", "Journey", "Kite", "Lemon", "Mountain", "Night", "Ocean", "Pirate", "Quest", "River", "Star", "Travel", "Unicorn", "Valley", "Whisper", "Xylophone", "Yellow", "Zebra", "Vision", "Wind", "Exotic", "Feather", "Sunset", "Rainbow", "Eclipse", "Meadow", "Galaxy", "Horizon", "Breeze", "Cascade", "Dewdrop", "Ember", "Frost", "Glacier", "Haven", "Icicle", "Jubilee", "Kaleidoscope", "Lagoon", "Mosaic", "Nebula", "Orbit", "Pebble", "Quartz", "Ripple", "Sapphire", "Tundra", "Utopia", "Vortex", "Willow", "Yonder", "Zenith", "Acorn", "Blizzard", "Comet", "Dandelion", "Evergreen", "Fjord", "Glimmer", "Harvest", "Infinity", "Jasmine", "Kestrel", "Lotus", "Meadowlark", "Nectar", "Oasis", "Pinecone", "Quill", "Reef", "Serenity", "Tapestry", "Umbrella", "Vivid", "Whirlwind", "Xenon", "Yacht", "Zephyr", "Aurora", "Bamboo", "Carnival", "Dragonfly", "Elixir", "Firefly", "Gazelle", "Hologram", "Iris", "Jaguar", "Kraken", "Labyrinth", "Magnet", "Nirvana", "Obsidian"
        ];
    }
    $password = '';

    for ($i = 0; $i < $wordCount; $i++) {
        $password .= $words[array_rand($words)];
    }

    for ($i = 0; $i < $numberCount; $i++) {
        $password .= mt_rand(0, 9);
    }

    for ($i = 0; $i < $symbolCount; $i++) {
        $password .= $symbols[mt_rand(0, strlen($symbols) - 1)];
    }

    if ($lowercase) {
        $password = strtolower($password);
    }

    return $password;
}