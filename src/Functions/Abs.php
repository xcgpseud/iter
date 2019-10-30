<?php

namespace Iter\Functions;

use Exception;
use Iter\Types\Iter;

/**
 * Trait Abs
 * @package Iter\Functions
 * @mixin Iter
 */
trait Abs
{
    /**
     * @return Iter
     * @throws Exception
     */
    public function abs(): Iter
    {
        $arr = [];
        foreach ($this->arr as $v) {
            $arr[] = $v < 0 ? -$v : $v;
        }
        return Iter::with($arr);
    }
}