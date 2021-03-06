<?php

namespace Validatiny\Test\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Rules\Callback;
use Validatiny\Validator;

class CallbackTest extends \PHPUnit_Framework_TestCase
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
        $validator = new Callback('is_string');

        $this->assertTrue($validator->validate($this->validator, "asd", Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
    }
}
