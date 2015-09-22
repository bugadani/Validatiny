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

    public function testObjectTypeValidatorWithoutValidatingTheObject()
    {
        $validator = new Object(__NAMESPACE__ . '\TestClass', false);

        $this->assertFalse($validator->validate($this->validator, "asd"));
        $this->assertTrue($validator->validate($this->validator, new TestClass()));
    }

    public function testObjectValidator()
    {
        $validator = new Object(__NAMESPACE__ . '\TestClass');

        $this->assertFalse($validator->validate($this->validator, new TestClass()));
        $this->assertTrue($validator->validate($this->validator, new TestClass('abcde')));
    }
}
