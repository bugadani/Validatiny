<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\StringRule;
use Validatiny\Validator;

class StringTest extends \PHPUnit_Framework_TestCase
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

    public function testDefaultStringValidator()
    {
        $validator = new StringRule();

        $this->assertTrue($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
    }

    public function testStringLengthValidator()
    {
        $validator = new StringRule(2, 3);

        $this->assertFalse($validator->validate($this->validator, "a", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, "as", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, "asdf", Validator::SCENARIO_ALL));
    }
}
