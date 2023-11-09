<?php
/**
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @website https://github.com/basteyy
 * @website https://eiweleit.de
 */

declare(strict_types=1);

namespace basteyy\Stringer\Times;

use DateInterval;
use DateTime;
use Exception;

/**
 * Returns a human-readable time difference. Use `$unitMap` to change the unit names.
 * @param DateTime|string|int $dateTime
 * @param bool $exact If true, the output will be in the format "1 hour, 2 minutes, 3 seconds", otherwise it will be in the format "1 hour".
 * @param array $unitMap An array of singular and plural names for the units. The key must be the same, first elements are the singular names and second elements plural names.
 * @return string
 * @throws Exception
 */
function getNiceTimeAgo(DateTime|string|int $dateTime,
                        bool                $exact = false,
                        array               $unitMap = [
                            'second' => ['sec', 'secs'],
                            'minute' => ['min', 'mins'],
                            'hour'   => ['hr', 'hrs'],
                            'day'    => ['day', 'days'],
                            'week'   => ['wk', 'wks'],
                            'month'  => ['mth', 'mths'],
                            'year'   => ['yr', 'yrs'],
                            'ago' => 'ago', 'now' => 'just now']): string
{
    if (!$dateTime instanceof DateTime) {
        $dateTime = new DateTime($dateTime);
    }

    /** @var DateInterval $diff */
    $diff = $dateTime->diff(new DateTime('now'));
    $time = ($diff->days * 24 * 60 * 60) + ($diff->h * 60 * 60) + ($diff->i * 60) + $diff->s;

    if ($exact) {
        $components = [];
        if ($diff->y > 0) $components[] = $diff->y . ' ' . ($diff->y > 1 ? $unitMap['year'][1] : $unitMap['year'][0]);
        if ($diff->m > 0) $components[] = $diff->m . ' ' . ($diff->m > 1 ? $unitMap['month'][1] : $unitMap['month'][0]);
        if ($diff->d > 0) $components[] = $diff->d . ' ' . ($diff->d > 1 ? $unitMap['day'][1] : $unitMap['day'][0]);
        if ($diff->h > 0) $components[] = $diff->h . ' ' . ($diff->h > 1 ? $unitMap['hour'][1] : $unitMap['hour'][0]);
        if ($diff->i > 0) $components[] = $diff->i . ' ' . ($diff->i > 1 ? $unitMap['minute'][1] : $unitMap['minute'][0]);
        if ($diff->s > 0) $components[] = $diff->s . ' ' . ($diff->s > 1 ? $unitMap['second'][1] : $unitMap['second'][0]);

        return $components ? implode(', ', $components) . ' ' . $unitMap['ago']  : $unitMap['now'];
    }

    if ($time <= 60) {
        return $time == 1 ? $unitMap['now'] : $time . " " . $unitMap['second'][1];
    }

    if ($time < 3600) {
        return round($time / 60) == 1 ? '1 ' . $unitMap['minute'][0] : round($time / 60) . ' ' . $unitMap['minute'][1];
    }

    if ($time < 86400) {
        return round($time / 3600) == 1 ? '1 ' . $unitMap['hour'][0] : round($time / 3600) . ' ' . $unitMap['hour'][1];
    }

    if ($time < 604800) {
        return round($time / 86400) == 1 ? '1 ' . $unitMap['day'][0] : round($time / 86400) . ' ' . $unitMap['day'][1];
    }

    if ($time < 2600640) {
        return round($time / 604800) == 1 ? '1 ' . $unitMap['week'][0] : round($time / 604800) . ' ' . $unitMap['week'][1];
    }

    if ($time < 31207680) {
        return round($time / 2600640) == 1 ? '1 ' . $unitMap['month'][0] : round($time / 2600640) . ' ' . $unitMap['month'][1];
    }

    return round($time / 31207680) == 1 ? '1 ' . $unitMap['year'][0] : round($time / 31207680) . ' ' . $unitMap['year'][1];
}