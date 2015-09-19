<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute rule
 * @Attribute('rule', type: 'Validatiny\Rule', required: true)
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
     * @param mixed     $object
     *
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        if(!is_array($object) && !$object instanceof \Traversable) {
            return false;
        }
        foreach ($object as $v) {
            if (!$this->rule->validate($validator, $v, $forScenario)) {
                return false;
            }
        }

        return true;
    }
}