<?php

namespace Validatiny;

class ObjectValidator extends AbstractRuleValidator
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

    protected function getApplicableRules($forScenario)
    {
        $rules = new \AppendIterator();
        $rules->append(new \ArrayIterator($this->propertyRules));
        $rules->append(new \ArrayIterator($this->methodRules));
        $rules->append(parent::getApplicableRules($forScenario));

        return $rules;
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