<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait All
 * @package Iter\Functions
 * @mixin Iter
 */
trait All
{
    /**
     * @param callable $fn
     * @return bool
     */
    public function all(callable $fn): bool
    {
        if (empty($this->arr)) {
            return false;
        }

        foreach ($this->arr as $v) {
            if (call_user_func($fn, $v) !== true) {
                return false;
            }
        }
        return true;
    }
}