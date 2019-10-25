<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait Break_
 * @package Iter\Functions
 * @mixin Iter
 */
trait Break_
{
    /**
     * @param callable|null $fn
     * @return self[]
     */
    public function break_(?callable $fn): array
    {
        $before = [];
        $after = [];

        if (is_null($fn)) {
            return [self::with($before), self::with($this->arr)];
        }

        $passed = false;

        foreach ($this->arr as $v) {
            if ($passed || call_user_func($fn, $v) === true) {
                $after[] = $v;
                $passed = true;
            } else {
                $before[] = $v;
            }
        }

        return [self::with($before), self::with($after)];
    }
}