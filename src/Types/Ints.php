<?php

namespace Iter\Types;

use Iter\Functions\{All, Any, Average, Break_, Map, Abs};

class Ints extends Iter
{
    use   Abs
        , All
        , Any
        , Average
        , Break_
        , Map;

    public static function with($arr): self
    {
        return new self($arr);
    }

    protected function verifyType()
    {
        foreach ($this->arr as $v) {
            if (!is_numeric($v)) {
                throw new \InvalidArgumentException("Ints value must contain only numerical values.");
            }
        }
    }
}