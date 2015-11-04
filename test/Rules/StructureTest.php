<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class StructureTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    /**
     * @return Validator
     */
    public function setUp()
    {
        $reader          = new AnnotationReader(new \Annotiny\AnnotationReader());
        $this->validator = new Validator($reader);
    }

    public function testArrayValidator()
    {
        $validator = new Structure(['foo', 'bar']);

        $this->assertTrue($validator->validate($this->validator, ['foo' => 1, 'bar' => 2], Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, ['foo' => 1, 'bar' => 2, 'baz' => 3], Validator::SCENARIO_ALL));
    }

    public function testStrictArrayValidator()
    {
        $validator = new Structure(['foo', 'bar'], true);

        $this->assertTrue($validator->validate($this->validator, ['foo' => 1, 'bar' => 2], Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, ['foo' => 1, 'bar' => 2, 'baz' => 3], Validator::SCENARIO_ALL));
    }

    public function testObjectValidator()
    {
        $validator = new Structure(['foo', 'bar']);

        $classOne = new \stdClass();
        $classTwo = new \stdClass();

        $classOne->foo = 1;
        $classOne->bar = 2;

        $classTwo->foo = 1;
        $classTwo->bar = 2;
        $classTwo->baz = 3;

        $this->assertTrue($validator->validate($this->validator, $classOne, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, $classTwo, Validator::SCENARIO_ALL));
    }

    public function testObjectArrayValidator()
    {
        $validator = new Structure(['foo', 'bar'], true);

        $classOne = new \stdClass();
        $classTwo = new \stdClass();

        $classOne->foo = 1;
        $classOne->bar = 2;

        $classTwo->foo = 1;
        $classTwo->bar = 2;
        $classTwo->baz = 3;

        $this->assertTrue($validator->validate($this->validator, $classOne, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, $classTwo, Validator::SCENARIO_ALL));
    }

}
