<?php

namespace Validatiny;

/**
 * A base class for all validators and Rule classes
 */
abstract class AbstractValidator
{
    /**
     * @param Validator       $validator
     * @param                 $object
     * @param string|string[] $forScenario
     *
     * @return bool
     */
    public abstract function validate(Validator $validator, $object, $forScenario);
}