<?php

namespace Validatiny;

class PropertyValidator extends AbstractValidator
{
    private $property;

    /**
     * @var Rule[]
     */
    private $rules = [];

    public function __construct($property)
    {
        $this->property = $property;
    }

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }

    /**
     * @param Validator $validator
     * @param           $object
     *
     * @return bool
     */
    public function validate(Validator $validator, $object)
    {
        if (!property_exists($object, $this->property)) {
            throw new \InvalidArgumentException("\$object does not have a public property called {$this->property}");
        }
        $value = $object->{$this->property};
        $valid = true;
        foreach ($this->rules as $rule) {
            $valid = $valid && $rule->validate($validator, $value);
        }

        return $valid;
    }
}