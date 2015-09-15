<?php

namespace Validatiny;

/**
 * A base class for all validators and Rule classes
 */
abstract class AbstractValidator
{
    /**
     * @param Validator $validator
     * @param           $object
     *
     * @return bool
     */
    public abstract function validate(Validator $validator, $object);
}