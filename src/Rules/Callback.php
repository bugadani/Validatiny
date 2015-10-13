<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation', 'class'})
 * @DefaultAttribute callback
 * @Attribute('callback', type: 'callable')
 */
class Callback extends Rule
{

    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
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
        return call_user_func($this->callback, $object);
    }
}