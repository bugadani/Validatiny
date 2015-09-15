<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class UnionTestClass {

    /**
     * @Union({@StringRule(), @Number(min: 2, max: 3)})
     */
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class UnionTest extends \PHPUnit_Framework_TestCase
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

    public function testUnionValidator()
    {
        $this->assertFalse($this->validator->validate(new UnionTestClass(0)));
        $this->assertFalse($this->validator->validate(new UnionTestClass(1)));
        $this->assertTrue($this->validator->validate(new UnionTestClass(2)));
        $this->assertTrue($this->validator->validate(new UnionTestClass("string")));
    }
}
