<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 */
class Optional extends DelegateRule
{

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
        if ($object === null) {
            return true;
        }

        return $this->rule->validate($validator, $object, $forScenario);
    }
}