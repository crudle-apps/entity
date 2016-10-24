<?php

namespace Crudle\Entity\Identity;

class IdentifiedByUuidTest extends \PHPUnit_Framework_TestCase
{
    public function test_uuid_is_generated_if_not_supplied()
    {
        /** @var IdentifiedByUuid $obj */
        $obj = $this->getMockForTrait(IdentifiedByUuid::class);
        $this->assertInstanceOf(Uuid::class, $obj->getId());
    }
}
