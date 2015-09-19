<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class PatternTest extends \PHPUnit_Framework_TestCase
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

    public function testPatternValidator()
    {
        $validator = new Pattern('/a{2}b{3}/');

        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, "aabb", Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, "aabbb", Validator::SCENARIO_ALL));
    }
}
