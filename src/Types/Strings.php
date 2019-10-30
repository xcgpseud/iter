<?php

namespace Iter\Types;

use Iter\Functions\{All, Any, Break_, Delete, Map};
use Exception;
use InvalidArgumentException;

class Strings extends Iter
{
    use   All
        , Any
        , Break_
        , Delete
        , Map;

    /**
     * @param $arr
     * @return Iter
     * @throws Exception
     */
    public static function with($arr): Iter
    {
        return new self($arr);
    }

    protected function verifyType()
    {
        foreach ($this->arr as $v) {
            if (!is_string($v)) {
                throw new InvalidArgumentException("Strings value must contain only string values.");
            }
        }
    }
}