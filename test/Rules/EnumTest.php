<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
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

        $this->assertTrue($validator->validate($this->validator, 'a'));
        $this->assertFalse($validator->validate($this->validator, 1));
        $this->assertTrue($validator->validate($this->validator, 2));
    }
}
