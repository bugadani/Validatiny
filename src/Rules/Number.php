<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @Attribute('min', type: 'number')
 * @Attribute('max', type: 'number')
 */
class Number extends Rule
{
    /**
     * @var int|float
     */
    private $min;

    /**
     * @var int|float
     */
    private $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param Validator $validator
     * @param           $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($this->min !== null) {
            if ($value < $this->min) {
                return false;
            }
        }
        if ($this->max !== null) {
            if ($value > $this->max) {
                return false;
            }
        }

        return true;
    }
}