<?php

namespace Validatiny\Rules;

use Validatiny\Readers\AnnotationReader;
use Validatiny\Validator;

class CollectionOfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @return Validator
     */
    public function setUp()
    {
        $reader          = new AnnotationReader(new \Annotiny\AnnotationReader());
        $this->validator = new Validator($reader);
    }

    public function testCollectionOfValidator()
    {
        $validator = new CollectionOf(new Number());

        $this->assertFalse($validator->validate($this->validator, "a", Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, 1, Validator::SCENARIO_ALL));
        $this->assertFalse($validator->validate($this->validator, ["a", "b", "c"], Validator::SCENARIO_ALL));
        $this->assertTrue($validator->validate($this->validator, [1, 2, 3], Validator::SCENARIO_ALL));
    }
}
