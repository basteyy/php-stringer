<?php
/**
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @website https://github.com/basteyy
 * @website https://eiweleit.de
 */

declare(strict_types=1);

use basteyy\Stringer as Stringer;

include __DIR__ . "/../vendor/autoload.php";

class RandomStringsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws Exception
     */
    public function testGetRandomAlphaNumericStringLength(): void
    {
        $length = 21;
        $string = Stringer\getRandomString($length);
        $this->assertSame($length, strlen($string));
    }

    /**
     * @throws Exception
     */
    public function testDefineCharacters(): void
    {
        $string = Stringer\getRandomString(3, 'a');
        $this->assertSame('aaa', $string);
    }
}