<?php

namespace Validatiny;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules as Validator;

class TestClass
{
    /**
     * @Validator\String(minLength: 5, maxLength:10)
     */
    public $prop = 'asfgg';

    /**
     * @Validator\Number(min: 10, max: 15)
     */
    public function method()
    {
        return 14;
    }
}

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testThatValidatorCallsReader()
    {
        $reader    = new AnnotationReader(new \Annotiny\AnnotationReader());
        $validator = new \Validatiny\Validator($reader);

        $this->assertTrue($validator->validate(new TestClass()));
    }
}
