<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * An enumeration of values
 *
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute elements
 * @Attribute('elements', type: {'mixed'}, required: true)
 */
class Enum extends Rule
{
    /**
     * @var array
     */
    private $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param Validator $validator
     * @param mixed     $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        return in_array($value, $this->elements);
    }
}