<?php

namespace Validatiny;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules as Validator;

class TestClass
{
    /**
     * @Validator\StringRule(minLength: 5, maxLength:10)
     */
    public $prop = 'asfgg';

    /**
     * @Validator\Number(min: 10, max: 15)
     * @Validator\Number(min: 10, max: 10, scenario: 'exact')
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

        $testClass = new TestClass();
        $this->assertTrue($validator->validate($testClass));
        $this->assertFalse($validator->validate($testClass, 'exact'));
    }
}
