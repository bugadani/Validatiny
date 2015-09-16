<?php

namespace Validatiny;

class MethodValidator extends AbstractValidator
{
    private $method;

    /**
     * @var Rule[]
     */
    private $rules = [];

    public function __construct($method)
    {
        $this->method = $method;
    }

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }

    public function validate(Validator $validator, $object)
    {
        if (!is_callable([$object, $this->method])) {
            throw new \InvalidArgumentException(
                "\$object (" . get_class($object) . ") does not have a public method called {$this->method}"
            );
        }
        $value = $object->{$this->method}();

        return array_reduce(
            $this->rules,
            function ($carry, Rule $rule) use ($validator, $value) {
                return $carry && $rule->validate($validator, $value);
            },
            true
        );
    }
}