<?php

namespace Validatiny;

/**
 * A Rule is a special kind of AbstractValidator.
 * Rules implementing this superclass can be used in PropertyValidator and
 * MethodValidator instances to validate object method results and properties.
 *
 * @Annotation
 * @Attribute('scenario', setter: 'setScenario')
 */
abstract class Rule extends AbstractValidator
{
    private $scenario = Validator::SCENARIO_ALL;

    public function setScenario($scenario)
    {
        if (!is_string($scenario)) {
            if (!is_array($scenario)) {
                $allStrings = false;
            } else {
                $allStrings = true;
                foreach ($scenario as $s) {
                    $allStrings = $allStrings && is_string($s);
                }
            }

            if (!$allStrings) {
                throw new \InvalidArgumentException('$scenario must be a string or an array of strings');
            }
        }
        $this->scenario = $scenario;
    }

    public function getScenario()
    {
        return $this->scenario;
    }
}