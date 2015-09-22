<?php

namespace Validatiny;

use Validatiny\Rules\BooleanRule;
use Validatiny\Rules\Number;
use Validatiny\Rules\StringRule;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testThatValidatorCallsReader()
    {
        $std = new \stdClass();

        $mockValidator = $this->getMock(__NAMESPACE__ . '\ObjectValidator', ['validate']);
        $mockReader    = $this->getMock(__NAMESPACE__ . '\RuleReader', ['getObjectValidator']);

        $validator = new Validator($mockReader);

        $mockReader->expects($this->once())
                   ->method('getObjectValidator')
                   ->with($this->equalTo($std))
                   ->will($this->returnValue($mockValidator));

        $mockValidator->expects($this->once())
                      ->method('validate')
                      ->with($this->equalTo($validator), $this->equalTo($std))
                      ->will($this->returnValue(true));

        $this->assertTrue($validator->validate($std));
    }

    public function testThatValidatorCallsRulesForScenario()
    {
        $std        = new \stdClass();
        $std->prop  = "foo";
        $std->other  = "foo";

        $mockReader = $this->getMock(__NAMESPACE__ . '\RuleReader', ['getObjectValidator']);

        $validator = new Validator($mockReader);

        $objectValidator = new ObjectValidator();

        $stringRule = new StringRule();
        $numberRule = new Number();
        $booleanRule = new BooleanRule();

        $stringRule->setScenario('string');
        $numberRule->setScenario('number');

        $objectValidator->addPropertyRule('prop', $stringRule);
        $objectValidator->addPropertyRule('prop', $numberRule);

        $mockReader->expects($this->any())
                   ->method('getObjectValidator')
                   ->with($this->equalTo($std))
                   ->will($this->returnValue($objectValidator));

        $this->assertFalse($validator->validate($std, "number"));
        $this->assertTrue($validator->validate($std, "string"));

        $booleanRule->setScenario(['string', 'number']);
        $objectValidator->addPropertyRule('other', $booleanRule);

        $this->assertFalse($validator->validate($std, "string"));
    }
}
