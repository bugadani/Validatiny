<?php

namespace Validatiny;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testThatValidatorCallsReader()
    {
        $std = new \stdClass();

        $mockValidator = $this->getMock(__NAMESPACE__ . '\ObjectValidator', ['validate']);
        $mockReader = $this->getMock(__NAMESPACE__ . '\RuleReader', ['getObjectValidator']);

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
}
