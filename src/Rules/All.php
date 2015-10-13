<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation', 'class'})
 * @DefaultAttribute rules
 * @Attribute('rules', type: { 'Validatiny\Rule' }, required: true)
 */
class All extends Rule
{
    /**
     * @var Rule[]
     */
    private $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param Validator $validator
     * @param mixed     $object
     *
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        foreach ($this->rules as $rule) {
            if (!$rule->validate($validator, $object, $forScenario)) {
                return false;
            }
        }

        return true;
    }
}