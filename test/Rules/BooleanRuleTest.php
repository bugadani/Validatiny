<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class BooleanRuleTest extends \PHPUnit_Framework_TestCase
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

    public function testBooleanValidator()
    {
        $validator = new BooleanRule();

        $this->assertTrue($validator->validate($this->validator, false));
        $this->assertTrue($validator->validate($this->validator, true));
        $this->assertFalse($validator->validate($this->validator, 1));
        $this->assertFalse($validator->validate($this->validator, null));
    }
}
