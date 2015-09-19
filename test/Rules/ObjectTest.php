<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
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

    public function testObjectTypeValidator()
    {
        $validator = new Object(__NAMESPACE__ . '\TestClass');

        $this->assertFalse($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, new TestClass(), Validator::SCENARIO_ALL));
    }

    public function testObjectValidatorValidator()
    {
        $validator = new Object(__NAMESPACE__ . '\TestClass', true);

        $this->assertFalse($validator->validate($this->validator, new TestClass(), Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, new TestClass('abcde'), Validator::SCENARIO_ALL));
    }
}
