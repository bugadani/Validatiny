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
     * @param           $object
     *
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        if (!is_string($object)) {
            return false;
        }

        $length = strlen($object);
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