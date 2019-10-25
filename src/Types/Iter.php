<?php

namespace Iter\Types;

abstract class Iter
{
    /** @var array */
    protected $arr;

    abstract protected function verifyType();

    protected function __construct($arr)
    {
        $this->arr = is_array($arr) ? $arr : [$arr];
        $this->verifyType();
    }

    public function get(): array
    {
        return $this->arr;
    }
}