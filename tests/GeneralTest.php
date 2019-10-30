<?php

namespace Tests;

use Exception;
use Iter\Types\Ints;
use Iter\Types\Strings;

class GeneralTest extends MainTestCase
{
    /**
     * @throws Exception
     */
    public function testTypeDetection(): void
    {
        $ints = Ints::with([1, 2, 3, 4, 5]);
        $strings = $ints->map(function ($v) { return (string)$v . " is a string."; });
        $this->assertInstanceOf(Strings::class, $strings);
        foreach ($strings->get() as $string) {
            $this->assertEquals(gettype($string), "string");
        }
    }
}