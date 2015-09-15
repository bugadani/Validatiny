<?php

namespace Validatiny\Readers;

use Annotiny\Comment;
use Validatiny\ObjectValidator;
use Validatiny\Rule;
use Validatiny\RuleReader;

class CachingReader extends RuleReader
{
    /**
     * @var RuleReader
     */
    private $reader;

    /**
     * @var ObjectValidator[]
     */
    private $validators = [];

    public function __construct(RuleReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string|object $object Class name or object instance
     *
     * @return ObjectValidator
     */
    public function getObjectValidator($object)
    {
        $class = get_class($object);
        if (!isset($this->validators[ $class ])) {
            $this->validators[ $class ] = $this->reader->getObjectValidator($object);
        }

        return $this->validators[ $class ];
    }
}