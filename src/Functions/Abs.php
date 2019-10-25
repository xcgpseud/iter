<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait Abs
 * @package Iter\Functions
 * @mixin Iter
 */
trait Abs
{
    public function abs(): self
    {
        $arr = [];
        foreach ($this->arr as $v) {
            $arr[] = $v < 0 ? -$v : $v;
        }
        return self::with($arr);
    }
}