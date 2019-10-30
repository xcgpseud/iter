<?php

namespace Iter\Types;

use Exception;

class Iter
{
    /** @var array */
    protected $arr;

    /**
     * @throws Exception
     */
    protected function verifyType()
    {
//        throw new Exception("Iter Verify Type not yet implemented");
    }

    /**
     * Iter constructor.
     * @param $arr
     * @throws Exception
     */
    protected function __construct($arr)
    {
        $this->arr = is_array($arr) ? $arr : [$arr];
        $this->verifyType();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->arr;
    }

    /**
     * @param $arr
     * @return static
     * @throws Exception
     */
    public static function with($arr): self
    {
        if (empty($arr)) {
            return new Iter($arr);
        }

        $firstElement = reset($arr);
        $type = gettype($firstElement);

        switch ($type) {
            case "string":
                return Strings::with($arr);
                break;
            case "integer":
                return Ints::with($arr);
                break;
            default:
                return new Iter([]);
//                echo $type;
//                throw new \InvalidArgumentException("Unrecognised type sent to Iter.");
        }
    }
}