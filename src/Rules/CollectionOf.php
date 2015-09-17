<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute rules
 * @Attribute('rules', type: { 'mixed' }, required: true)
 */
class CollectionOf extends Rule
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
     * @param mixed     $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        if(!is_array($value) && !$value instanceof \Traversable) {
            return false;
        }
        foreach ($value as $v) {
            if (!$this->rule->validate($validator, $v)) {
                return false;
            }
        }

        return true;
    }
}