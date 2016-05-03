<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class AllTestClass {

    /**
     * @Validatiny\Rules\All({
     *  @Validatiny\Rules\StringRule(minLength: 2, maxLength: 5),
     *  @Validatiny\Rules\Enum({"foo", "foobar"})
     * })
     */
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class AllTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @return Validator
     */
    public function setUp()
    {
        $reader          = new AnnotationReader(new \Annotiny\AnnotationReader());
        $this->validator = new Validator($reader);
    }

    public function testAllValidator()
    {
        $this->assertFalse($this->validator->validate(new AllTestClass("baz"))); //not in enum
        $this->assertFalse($this->validator->validate(new AllTestClass("foobar")));//wrong length
        $this->assertTrue($this->validator->validate(new AllTestClass("foo")));
    }
}
