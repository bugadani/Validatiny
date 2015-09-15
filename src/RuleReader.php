<?php

namespace Validatiny;

abstract class RuleReader
{
    /**
     * @param string|object $object Class name or object instance
     *
     * @return ObjectValidator
     */
    public abstract function getObjectValidator($object);
}