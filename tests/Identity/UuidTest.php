<?php

namespace Crudle\Entity\Identity;

class UuidTest extends \PHPUnit_Framework_TestCase
{
    public function test_generate_created_36_byte_uuid()
    {
        $id = Uuid::generate();
        $this->assertNotEmpty((string) $id);
        $this->assertEquals(36, strlen($id));
    }

    public function test_uuid_is_32_hexidecimal_bytes_once_dashes_are_removed()
    {
        $id = Uuid::generate();
        $this->assertNotEmpty((string) $id);
        $this->assertEquals(32, strlen(str_replace('-', '', $id)));
    }

    public function test_uuid_can_be_easily_converted_to_hex()
    {
        $id = Uuid::generate();
        $this->assertNotEmpty((string) $id);
        $this->assertEquals(str_replace('-', '', $id), $id->toHex());
    }

    public function test_construct_can_handle_uuid_objects()
    {
        $id = Uuid::generate();
        $new = new Uuid($id);
        $this->assertEquals($id, $new);
    }

    public function test_uuids_always_unique_and_valid_binary()
    {
        $ids = [];
        foreach (range(1, 1000) as $i) {
            $id = Uuid::generate();
            $ids[$id->toBinary()] = $id;
        }
        $this->assertEquals(1000, count($ids));
        foreach ($ids as $binary => $id) {
            $this->assertEquals($id, Uuid::createFromBinary($binary));
        }
    }
}
