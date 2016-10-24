<?php

namespace Crudle\Entity\Property;

use Crudle\Entity\Exception\ActionNotSupportedException;
use Crudle\Entity\Exception\UndefinedException;

trait PrivateImmutableAttributes
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
        if (!key_exists($key, $this->attributes)) {
            throw UndefinedException::from($key);
        }

        return $this->attributes[$key];
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @throws ActionNotSupportedException
     *  When attempting to modify an existing property
     *
     * @return $this
     */
    protected function set($key, $value)
    {
        if (!key_exists($key, $this->attributes)) {
            $this->attributes[$key] = $value;

            return $this;
        }

        throw new ActionNotSupportedException("Attempted to modify the value of property `$key` but this property is immutable");
    }
}
