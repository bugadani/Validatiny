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
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        $valid = true;

        $iterator = new \AppendIterator();
        $iterator->append(new \ArrayIterator($this->propertyRules));
        $iterator->append(new \ArrayIterator($this->methodRules));

        /** @var AbstractRuleValidator $rule */
        foreach ($iterator as $rule) {
            $valid = $valid && $rule->validate($validator, $object, $forScenario);
        }

        return $valid;
    }
}