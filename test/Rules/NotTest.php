<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\Not;
use Validatiny\Rules\StringRule;
use Validatiny\Validator;

class NotTest extends \PHPUnit_Framework_TestCase
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

    public function testNotValidator()
    {
        $validator = new Not(new StringRule());

        $this->assertTrue($validator->validate($this->validator, null, Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
    }
}
