<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class OptionalTest extends \PHPUnit_Framework_TestCase
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

    public function testOptionalValidator()
    {
        $validator = new Optional(new StringRule());

        $this->assertTrue($validator->validate($this->validator, null));
        $this->assertTrue($validator->validate($this->validator, "asd"));
        $this->assertFalse($validator->validate($this->validator, 1));
    }
}
