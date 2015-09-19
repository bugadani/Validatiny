<?php

namespace Validatiny;

class MethodValidator extends AbstractRuleValidator
{
    private $method;

    public function __construct($method)
    {
        $this->method = $method;
    }

    public function validate(Validator $validator, $object, $forScenario)
    {
        if (!is_callable([$object, $this->method])) {
            throw new \InvalidArgumentException(
                "\$object (" . get_class($object) . ") does not have a public method called {$this->method}"
            );
        }
        $value = $object->{$this->method}();

        return array_reduce(
            $this->getApplicableRules($forScenario),
            function ($carry, Rule $rule) use ($validator, $value, $forScenario) {
                return $carry && $rule->validate($validator, $value, $forScenario);
            },
            true
        );
    }
}