<?php

namespace Validatiny;

/**
 * A Rule is a special kind of AbstractValidator.
 * Rules implementing this superclass can be used in PropertyValidator and
 * MethodValidator instances to validate object method results and properties.
 */
abstract class Rule extends AbstractValidator
{
}