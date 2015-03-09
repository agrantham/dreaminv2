<?php 


class UUIDValidationTest extends TestCase {

	public function testUUIDTest() {
		Package::load("UUID");

		$UUID1 = UUID::mint(1);
		$this->assertInstanceOf("UUID", $UUID1, "UUID 1 Class test");
		$this->assertTrue(is_string($UUID1->string), "UUID1 converstion");

	}
}