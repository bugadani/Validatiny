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
 * @Attribute('rules', type: { 'mixed' }, required: true)
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
     * @param mixed     $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        foreach ($this->rules as $rule) {
            if ($rule->validate($validator, $value)) {
                return true;
            }
        }

        return false;
    }
}