<?php

namespace Crudle\Entity\Property;

use Crudle\Entity\Exception\UndefinedException;

trait PrivateAttributes
{
    /**
     * @var mixed[]
     */
    protected $attributes = [];

    /**
     * @param mixed $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function get($key, $default = null)
    {
        return $this->attributes[$key] ?? $default;
    }

    /**
     * @param mixed $key
     *
     * @throws UndefinedException
     *  When a property of the given key is not defined
     *
     * @return mixed
     */
    protected function getOrFail($key)
    {
        if (key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        throw UndefinedException::from($key);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    protected function set($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }
}
