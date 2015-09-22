<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * An union of validation rules, one of them must be valid for the rule to be valid
 *
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute rules
 * @Attribute('rules', type: { 'Validatiny\Rule' }, required: true)
 */
class Union extends Rule
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
            if ($rule->validate($validator, $object, $forScenario)) {
                return true;
            }
        }

        return false;
    }
}