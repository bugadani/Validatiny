<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
 * @DefaultAttribute className
 * @Attribute('className', type: 'string', required: true)
 * @Attribute('validate', type: 'bool')
 */
class Object extends Rule
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var bool
     */
    private $validate;

    public function __construct($className, $validate = true)
    {
        $this->className = $className;
        $this->validate  = $validate;
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
        if (!$object instanceof $this->className) {
            return false;
        }

        if ($this->validate) {
            return $validator->validate($object);
        }

        return true;
    }
}