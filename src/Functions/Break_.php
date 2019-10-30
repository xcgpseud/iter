<?php

namespace Iter\Functions;

use Exception;
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
     * @return array
     * @throws Exception
     */
    public function break_(?callable $fn): array
    {
        $before = [];
        $after = [];

        if (is_null($fn)) {
            return [Iter::with($before), Iter::with($this->arr)];
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

        return [Iter::with($before), Iter::with($after)];
    }
}