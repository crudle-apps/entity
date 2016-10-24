<?php

namespace Crudle\Entity\Property;

use Crudle\Entity\Exception\ActionNotSupportedException;
use Crudle\Entity\Exception\UndefinedException;

class PrivateImmutableAttributesTest extends \PHPUnit_Framework_TestCase
{
    use PrivateImmutableAttributes;

    public function test_can_set_and_get_attributes()
    {
        $this->assertFalse(isset($this->attributes['test']));
        $this->set('test', 'Has been set');
        $this->assertTrue(isset($this->attributes['test']));
        $this->assertEquals('Has been set', $this->attributes['test']);
        $this->assertEquals('Has been set', $this->get('test'));
    }

    public function test_cannot_modify_attributes_once_set()
    {
        $this->set('test_attribute', 'Has been set');

        $this->expectException(ActionNotSupportedException::class);

        $this->set('test_attribute', 69);
    }

    public function test_default_can_be_passed_back_when_attribute_is_not_set()
    {
        $this->assertEquals('default', $this->get('def', 'default'));
    }

    public function test_exception_thrown_when_strictly_getting_non_existent_attribute()
    {
        $this->expectException(UndefinedException::class);
        $this->getOrFail('will_fail');
    }
}
