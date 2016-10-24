<?php

namespace Crudle\Entity\Exception;

class UndefinedException extends \Exception
{
    /**
     * @param mixed $item
     * @return UndefinedException
     */
    public static function from($item): UndefinedException
    {
        return new static("Property `$item` has not been defined.");
    }
}
