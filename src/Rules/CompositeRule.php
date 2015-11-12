<?php

namespace Validatiny\Rules;

use Validatiny\Rule;

/**
 * CompositeRule aggregates a set of rules into one.
 *
 * @Annotation
 * @Target({'method', 'property', 'annotation', 'class'})
 * @DefaultAttribute rules
 * @Attribute('rules', type: { 'Validatiny\Rule' }, required: true)
 */
abstract class CompositeRule extends Rule
{

    /**
     * @var Rule[]
     */
    protected $rules;

    /**
     * @var bool
     */
    private $readOnly = false;

    public function __construct($rules = [])
    {
        if ($rules instanceof \Traversable) {
            $this->readOnly = true;
        } else if (!is_array($rules)) {
            throw new \InvalidArgumentException('$rules must be an array or a Traversable object');
        }
        $this->rules = $rules;
    }

    public function addRule(Rule $rule)
    {
        if ($this->readOnly) {
            throw new \BadMethodCallException('This composite rule is read-only');
        }

        $this->rules[] = $rule;
    }

    public function merge(CompositeRule $other)
    {
        return new static(array_merge($this->rules, $other->rules));
    }
}