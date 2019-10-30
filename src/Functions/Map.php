<?php

namespace Iter\Functions;

use Exception;
use Iter\Types\Iter;

/**
 * Trait Map
 * @package Iter\Functions
 * @mixin Iter
 */
trait Map
{
    /**
     * @param callable $fn
     * @return Map
     * @throws Exception
     */
    public function map(?callable $fn): Iter
    {
        if (is_null($fn)) {
            return Iter::with($this->arr);
        }
        $arr = [];
        foreach ($this->arr as $v) {
            $arr[] = call_user_func($fn, $v);
        }
        return Iter::with($arr);
    }
}