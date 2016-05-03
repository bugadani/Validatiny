<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\Enum;
use Validatiny\Validator;

class EnumTest extends \PHPUnit_Framework_TestCase
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

    public function testEnumValidator()
    {
        $validator = new Enum(['a', 'b', 2, 3]);

        $this->assertTrue($validator->validate($this->validator, 'a', Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, 2, Validator::SCENARIO_ALL));
    }
}
