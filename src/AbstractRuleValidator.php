<?php

namespace Validatiny;

use Validatiny\Rules\All;

abstract class AbstractRuleValidator extends AbstractValidator
{
    /**
     * @var Rule[][]
     */
    private $rules = ['all' => []];

    private function addRuleForScenario(Rule $rule, $scenario)
    {
        if (!isset($this->rules[ $scenario ])) {
            $this->rules[ $scenario ] = [];
        }
        $this->rules[ $scenario ][] = $rule;
    }

    public function addRule(Rule $rule)
    {
        $scenario = $rule->getScenario();

        if (is_array($scenario)) {
            foreach ($scenario as $sc) {
                $this->addRuleForScenario($rule, $sc);
            }
        } else {
            $this->addRuleForScenario($rule, $scenario);
        }
    }

    /**
     * @param Validator $validator
     * @param           $object
     * @param           $forScenario
     *
     * @return bool
     */
    public function validate(Validator $validator, $object, $forScenario)
    {
        $rules = $this->getApplicableRules($forScenario);

        $validationMethod = new All($rules);

        return $validationMethod->validate(
            $validator,
            $this->getValue($object),
            $forScenario
        );
    }

    /**
     * @param $forScenario
     *
     * @return \ArrayIterator
     */
    protected function getApplicableRules($forScenario)
    {
        $rules = $this->rules['all'];
        if ($forScenario !== 'all' && isset($this->rules[ $forScenario ])) {
            $rules = array_merge($rules, $this->rules[ $forScenario ]);
        }

        return new \ArrayIterator($rules);
    }

    protected abstract function getValue($object);
}