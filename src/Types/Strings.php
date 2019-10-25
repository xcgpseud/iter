<?php

namespace Iter\Types;

use Iter\Functions\{All, Any, Break_, Delete, Map};

class Strings extends Iter
{
    use   All
        , Any
        , Break_
        , Delete
        , Map;

    public static function with($arr): self
    {
        return new self($arr);
    }

    protected function verifyType()
    {
        foreach ($this->arr as $v) {
            if (!is_string($v)) {
                throw new \InvalidArgumentException("Strings value must contain only string values.");
            }
        }
    }
}