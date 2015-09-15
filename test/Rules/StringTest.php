<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
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

        $this->assertTrue($validator->validate($this->validator, "asd"));
        $this->assertFalse($validator->validate($this->validator, 1));
    }

    public function testStringLengthValidator()
    {
        $validator = new StringRule(2, 3);

        $this->assertFalse($validator->validate($this->validator, "a"));
        $this->assertTrue($validator->validate($this->validator, "as"));
        $this->assertTrue($validator->validate($this->validator, "asd"));
        $this->assertFalse($validator->validate($this->validator, "asdf"));
    }
}
