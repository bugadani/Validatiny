<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute fields
 * @Attribute('fields', type: {'string'})
 * @Attribute('strict', type: 'bool')
 */
class Structure extends Rule
{
    /**
     * @var \string[]
     */
    private $fields;

    /**
     * @var bool
     */
    private $strict;

    /**
     * @param string[] $fields
     * @param bool $strict
     */
    public function __construct($fields, $strict = false)
    {
        $this->fields = $fields;
        $this->strict = $strict;
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
        if (is_object($object)) {
            //get all accessible non-static properties
            $object = get_object_vars($object);
        } else if (!is_array($object)) {
            //$object is a primitive value
            return false;
        }

        $arrayKeys = array_keys($object);
        if ($this->strict) {
            return $arrayKeys === $this->fields;
        } else {
            $diff = array_diff($this->fields, $arrayKeys);

            return empty($diff);
        }
    }
}