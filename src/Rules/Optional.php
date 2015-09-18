<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute rule
 * @Attribute('rule', type: 'mixed')
 */
class Optional extends Rule
{

    /**
     * @var Rule
     */
    private $rule;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @param Validator $validator
     * @param           $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        if ($value === null) {
            return true;
        }

        return $this->rule->validate($validator, $value);
    }
}