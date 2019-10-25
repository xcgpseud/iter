<?php

namespace Iter\Functions;

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
     */
    public function map(?callable $fn): self
    {
        if (is_null($fn)) {
            return self::with($this->arr);
        }
        $arr = [];
        foreach ($this->arr as $v) {
            $arr[] = call_user_func($fn, $v);
        }
        return self::with($arr);
    }
}