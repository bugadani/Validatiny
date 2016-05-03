<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\CallableRule;
use Validatiny\Validator;

class CallableRuleTest extends \PHPUnit_Framework_TestCase
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
        $validator = new CallableRule('is_string');

        $this->assertTrue($validator->validate(
            $this->validator,
            function () {
            },
            Validator::SCENARIO_ALL
        ));
        $this->assertFalse($validator->validate($this->validator, 'foobar', Validator::SCENARIO_ALL));
    }
}
