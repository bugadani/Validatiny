<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\Object;
use Validatiny\Validator;

class TestClass
{
    /**
     * @Validatiny\Rules\StringRule(minLength: 5, maxLength:10)
     */
    public $prop;

    public function __construct($string = '')
    {
        $this->prop = $string;
    }
}

class ObjectTest extends \PHPUnit_Framework_TestCase
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

    public function testObjectTypeValidatorWithoutValidatingTheObject()
    {
        $validator = new Object(TestClass::class, false);

        $this->assertFalse($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, new TestClass(), Validator::SCENARIO_ALL));
    }

    public function testObjectValidator()
    {
        $validator = new Object(TestClass::class);

        $this->assertFalse($validator->validate($this->validator, new TestClass(), Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, new TestClass('abcde'), Validator::SCENARIO_ALL));
    }
}
