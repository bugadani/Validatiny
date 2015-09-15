<?php

namespace Validatiny;

class ObjectValidator extends AbstractValidator
{
    /**
     * @var PropertyValidator[]
     */
    private $propertyRules;

    /**
     * @var MethodValidator[]
     */
    private $methodRules;

    public function __construct()
    {
        $this->propertyRules = [];
        $this->methodRules   = [];
    }

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

    /**
     * @param Validator $validator
     * @param           $object
     *
     * @return bool
     */
    public function validate(Validator $validator, $object)
    {
        $valid = true;
        foreach ($this->propertyRules as $property => $propertyvalidator) {
            $valid = $valid && $propertyvalidator->validate($validator, $object);
        }
        foreach ($this->methodRules as $method => $methodvalidator) {
            $valid = $valid && $methodvalidator->validate($validator, $object);
        }

        return $valid;
    }
}