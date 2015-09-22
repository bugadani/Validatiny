<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute pattern
 * @Attribute('pattern', type: 'string', required: true)
 */
class Pattern extends Rule
{
    /**
     * @var string
     */
    private $pattern;

    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    public function validate(Validator $validator, $object, $forScenario)
    {
        return preg_match($this->pattern, (string)$object) === 1;
    }
}