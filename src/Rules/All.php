<?php

namespace Validatiny\Rules;

use Validatiny\Validator;

/**
 * @Annotation
 */
class All extends CompositeRule
{
    /**
     * @param Validator $validator
     * @param mixed $object
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