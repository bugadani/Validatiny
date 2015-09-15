<?php

namespace Validatiny;

class Validator
{
    /**
     * @var RuleReader
     */
    private $reader;

    public function __construct(RuleReader $reader)
    {
        $this->reader = $reader;
    }

    public function validate($object)
    {
        $validator = $this->reader->getObjectValidator($object);

        return $validator->validate($this, $object);
    }
}