<?php

namespace Validatiny;

class Validator
{
    const SCENARIO_ALL = 'all';

    /**
     * @var RuleReader
     */
    private $reader;

    public function __construct(RuleReader $reader)
    {
        $this->reader = $reader;
    }

    public function validate($object, $forScenario = self::SCENARIO_ALL)
    {
        if (!is_string($forScenario)) {
            throw new \InvalidArgumentException('$forScenario must be a string');
        }
        $validator = $this->reader->getObjectValidator($object);

        return $validator->validate($this, $object, $forScenario);
    }
}