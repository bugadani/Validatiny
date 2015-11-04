<?php

namespace Validatiny;

class PropertyValidator extends AbstractRuleValidator
{
    private $property;

    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * @param $object
     * @return mixed
     */
    protected function getValue($object)
    {
        if (!property_exists($object, $this->property)) {
            throw new \InvalidArgumentException(
                "\$object does not have a public property called {$this->property}"
            );
        }
        $value = $object->{$this->property};

        return $value;
    }
}