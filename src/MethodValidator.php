<?php

namespace Validatiny;

class MethodValidator extends AbstractRuleValidator
{
    private $method;

    public function __construct($method)
    {
        parent::__construct();

        $this->method = $method;
    }

    /**
     * @param $object
     * @return mixed
     */
    protected function getValue($object)
    {
        if (!is_callable([$object, $this->method])) {
            throw new \InvalidArgumentException(
                "\$object (" . get_class($object) . ") does not have a public method called {$this->method}"
            );
        }
        $value = $object->{$this->method}();

        return $value;
    }
}