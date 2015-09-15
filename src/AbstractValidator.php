<?php

namespace Validatiny;

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