<?php

namespace Crudle\Entity\Identity;

trait IdentifiedByUuid
{
    /**
     * @param string|Uuid $id
     */
    public function __construct($id = null)
    {
        $this->setId($id ?: Uuid::generate());
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        if (isset($this->attributes) && method_exists($this, 'get')) {
            return $this->get('id');
        }

        return $this->attributes['id'];
    }

    /**
     * @param string|Uuid $id
     * @return $this
     */
    private function setId($id)
    {
        if (isset($this->attributes) && method_exists($this, 'set')) {
            return $this->set('id', new Uuid($id));
        }

        $this->attributes['id'] = new Uuid($id);

        return $this;
    }

    /**
     * Get a shortened version of the ID.
     *
     * Returns a 10-character hash of the ID
     *
     * This should be avoided as there are higher changes of collisions
     * between IDs. We offer no guarantees that the shortened ID is
     * 100% unique. It can be useful however if you need a short reference
     * for an entity where you have other criteria available to
     * validate you have the correct item
     */
    public function getShortId(): string
    {
        return substr(md5($this->getId()), 0, 10);
    }
}
