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
        $arrayOne   = ['foo' => 1];
        $arrayTwo   = ['foo' => 1, 'bar' => 2];
        $arrayThree = ['foo' => 1, 'bar' => 2, 'baz' => 3];

        $validator = new Structure(['foo', 'bar']);
        $this->assertFalse($validator->validate($this->validator, $arrayOne, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, $arrayTwo, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, $arrayThree, Validator::SCENARIO_ALL));

        $strictValidator = new Structure(['foo', 'bar'], true);
        $this->assertFalse($strictValidator->validate($this->validator, $arrayOne, Validator::SCENARIO_ALL));
        $this->assertTrue($strictValidator->validate($this->validator, $arrayTwo, Validator::SCENARIO_ALL));
        $this->assertFalse($strictValidator->validate($this->validator, $arrayThree, Validator::SCENARIO_ALL));
    }

    public function testObjectValidator()
    {
        $classOne   = new \stdClass();
        $classTwo   = new \stdClass();
        $classThree = new \stdClass();

        $classOne->foo = 1;

        $classTwo->foo = 1;
        $classTwo->bar = 2;

        $classThree->foo = 1;
        $classThree->bar = 2;
        $classThree->baz = 3;

        $validator = new Structure(['foo', 'bar']);
        $this->assertFalse($validator->validate($this->validator, $classOne, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, $classTwo, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, $classThree, Validator::SCENARIO_ALL));

        $strictValidator = new Structure(['foo', 'bar'], true);
        $this->assertFalse($strictValidator->validate($this->validator, $classOne, Validator::SCENARIO_ALL));
        $this->assertTrue($strictValidator->validate($this->validator, $classTwo, Validator::SCENARIO_ALL));
        $this->assertFalse($strictValidator->validate($this->validator, $classThree, Validator::SCENARIO_ALL));
    }
}
