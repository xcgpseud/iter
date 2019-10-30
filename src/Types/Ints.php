<?php

namespace Iter\Types;

use Iter\Functions\{All, Any, Average, Break_, Delete, Map, Abs};
use Exception;

class Ints extends Iter
{
    use   Abs
        , All
        , Any
        , Average
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
            if (!is_numeric($v)) {
                throw new \InvalidArgumentException("Ints value must contain only numerical values.");
            }
        }
    }
}