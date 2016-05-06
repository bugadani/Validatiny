<?php

namespace Validatiny\Rules;

use Validatiny\Validator;

/**
 * @Annotation
 */
class CollectionOf extends DelegateRule
{
    /**
     * @param Validator $validator
     * @param mixed $object
     *
     * @param $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        if (!is_array($object) && !$object instanceof \Traversable) {
            return false;
        }

        foreach ($object as $v) {
            if(!$this->rule->validate($validator, $v, $forScenario)) {
                return false;
            }
        }

        return true;
    }
}