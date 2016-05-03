<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\Number;
use Validatiny\Validator;

class NumberTest extends \PHPUnit_Framework_TestCase
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

    public function testDefaultNumberValidator()
    {
        $validator = new Number();

        $this->assertFalse($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
    }

    public function testNumberRangeValidator()
    {
        $validator = new Number(2, 3);

        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, 2, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, 3, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 3.2, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 4, Validator::SCENARIO_ALL));
    }
}
