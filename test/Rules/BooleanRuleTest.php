<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\BooleanRule;
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

        $this->assertTrue($validator->validate($this->validator, false, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, true, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, null, Validator::SCENARIO_ALL));
    }
}
