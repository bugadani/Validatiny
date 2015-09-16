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

        return array_reduce(
            $this->rules,
            function ($carry, Rule $rule) use ($validator, $value) {
                return $carry && $rule->validate($validator, $value);
            },
            true
        );
    }
}