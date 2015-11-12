<?php

namespace Validatiny;

use Validatiny\Rules\All;

class ObjectValidator extends AbstractRuleValidator
{
    /**
     * @var PropertyValidator[]
     */
    private $propertyRules = [];

    /**
     * @var MethodValidator[]
     */
    private $methodRules = [];

    public function addPropertyRule($property, Rule $rule)
    {
        if (!isset($this->propertyRules[ $property ])) {
            $this->propertyRules[ $property ] = new PropertyValidator($property);
        }
        $this->propertyRules[ $property ]->addRule($rule);
    }

    public function addMethodRule($method, Rule $rule)
    {
        if (!isset($this->methodRules[ $method ])) {
            $this->methodRules[ $method ] = new MethodValidator($method);
        }
        $this->methodRules[ $method ]->addRule($rule);
    }

    protected function getApplicableRules($forScenario)
    {
        return new All([
            new All($this->propertyRules),
            new All($this->methodRules),
            parent::getApplicableRules($forScenario),
        ]);
    }

    protected function getValue($object)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException(
                "\$object is not an object"
            );
        }

        return $object;
    }
}