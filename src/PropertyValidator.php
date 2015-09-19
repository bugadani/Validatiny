<?php

namespace Validatiny;

class PropertyValidator extends AbstractRuleValidator
{
    private $property;

    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * @param Validator $validator
     * @param           $object
     *
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        if (!property_exists($object, $this->property)) {
            throw new \InvalidArgumentException("\$object does not have a public property called {$this->property}");
        }
        $value = $object->{$this->property};

        return array_reduce(
            $this->getApplicableRules($forScenario),
            function ($carry, Rule $rule) use ($validator, $value, $forScenario) {
                return $carry && $rule->validate($validator, $value, $forScenario);
            },
            true
        );
    }
}