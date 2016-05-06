<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * An union of validation rules, one of them must be valid for the rule to be valid
 *
 * @Annotation
 */
class Union extends CompositeRule
{

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
        $valid = false;

        foreach ($this->rules as $rule) {
            $valid = $valid || $rule->validate($validator, $object, $forScenario);
        }

        return $valid;
    }
}