<?php

namespace Validatiny\Rules;

use Validatiny\Rule;
use Validatiny\Validator;

/**
 * @Annotation
 * @Target({'method', 'property', 'annotation'})
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
     * @param           $value
     *
     * @return bool
     */
    public function validate(Validator $validator, $value)
    {
        $callback = $this->callback;

        return $callback($value);
    }
}