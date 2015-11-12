<?php

namespace Validatiny\Rules;

use Validatiny\Rule;

/**
 * Abstract parent of rules that validate using other rules received as constructor parameter
 *
 * @Annotation
 * @Target({'method', 'property', 'annotation', 'class'})
 * @DefaultAttribute rule
 * @Attribute('rule', type: 'Validatiny\Rule', required: true)
 */
abstract class DelegateRule extends Rule
{
    /**
     * @var Rule
     */
    protected $rule;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }
}