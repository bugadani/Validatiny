<?php

namespace Validatiny;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules as Validator;

/**
 * @Validator\Callback(TestClass::validator)
 */
class TestClass
{
    /**
     * @Validator\StringRule(minLength: 5, maxLength:10)
     */
    public $prop = 'asfgg';

    public $validatorCalled = false;

    public static function validator(TestClass $object)
    {
        $object->validatorCalled = true;
        return true;
    }

    /**
     * @Validator\Number(min: 10, max: 10, scenario: 'exact')
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

        $testClass = new TestClass();
        $this->assertTrue($validator->validate($testClass));
        $this->assertTrue($testClass->validatorCalled);

        $testClass = new TestClass();
        $this->assertFalse($validator->validate($testClass, 'exact'));
        $this->assertFalse($testClass->validatorCalled);
    }
}
