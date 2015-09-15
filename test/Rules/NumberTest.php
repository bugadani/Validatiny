<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
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

        $this->assertFalse($validator->validate($this->validator, "asd"));
        $this->assertTrue($validator->validate($this->validator, 1));
    }

    public function testNumberRangeValidator()
    {
        $validator = new Number(2, 3);

        $this->assertFalse($validator->validate($this->validator, 1));
        $this->assertTrue($validator->validate($this->validator, 2));
        $this->assertTrue($validator->validate($this->validator, 3));
        $this->assertFalse($validator->validate($this->validator, 3.2));
        $this->assertFalse($validator->validate($this->validator, 4));
    }
}
