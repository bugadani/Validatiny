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
        $valid = true;
        foreach ($this->rules as $rule) {
            $valid = $valid && $rule->validate($validator, $object, $forScenario);
        }

        return $valid;
    }
}