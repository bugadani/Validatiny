<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @Attribute('minLength', type: 'int')
 * @Attribute('maxLength', type: 'int')
 */
class StringRule extends Rule
{
    /**
     * @var int
     */
    private $minLength;

    /**
     * @var int
     */
    private $maxLength;

    public function __construct($minLength = null, $maxLength = null)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * @param Validator $validator
     * @param           $string
     *
     * @return bool
     */
    public function validate(Validator $validator, $string)
    {
        if (!is_string($string)) {
            return false;
        }

        $length = strlen($string);
        if ($this->minLength !== null) {
            if ($length < $this->minLength) {
                return false;
            }
        }
        if ($this->maxLength !== null) {
            if ($length > $this->maxLength) {
                return false;
            }
        }

        return true;
    }
}