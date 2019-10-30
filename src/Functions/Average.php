<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait Average
 * @package Iter\Functions
 * @mixin Iter
 */
trait Average
{
    /**
     * @return float
     */
    public function average(): float
    {
        if (count($this->arr) === 0) {
            return 0;
        }
        $sum = 0;
        foreach ($this->arr as $v) {
            $sum += $v;
        }
        return $sum / count($this->arr);
    }
}