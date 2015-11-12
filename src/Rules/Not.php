<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 */
class Not extends DelegateRule
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
        return !$this->rule->validate($validator, $object, $forScenario);
    }
}