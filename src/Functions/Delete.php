<?php

namespace Iter\Functions;

use Iter\Types\Iter;

/**
 * Trait Delete
 * @package Iter\Functions
 * @mixin Iter
 */
trait Delete
{
    public function delete($value): Iter
    {
        $out = [];
        $deleted = false;
        foreach ($this->arr as $v) {
            if ($deleted || $v !== $value) {
                $out[] = $v;
            } else {
                $deleted = true;
            }
        }
        return Iter::with($out);
    }
}