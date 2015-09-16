<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 */
class CallableRule extends Rule
{

    /**
     * @param Validator $validator
     * @param           $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        return is_callable($value);
    }
}