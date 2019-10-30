<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait Any
 * @package Iter\Functions
 * @mixin Iter
 */
trait Any
{
    /**
     * @param $fn
     * @return bool
     */
    public function any($fn): bool
    {
        if (empty($this->arr)) {
            return false;
        }

        foreach ($this->arr as $v) {
            if (call_user_func($fn, $v) === true) {
                return true;
            }
        }
        return false;
    }
}