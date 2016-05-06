<?php

namespace Validatiny;

use Validatiny\Rules\All;
use Validatiny\Rules\CompositeRule;

abstract class AbstractRuleValidator extends AbstractValidator
{
    /**
     * @var CompositeRule[]
     */
    private $rules = [];

    public function __construct()
    {
        $this->rules[ Validator::SCENARIO_ALL ] = new All();
    }

    private function addRuleForScenario(Rule $rule, $scenario)
    {
        if (!isset($this->rules[ $scenario ])) {
            //Pass 'all' so that we won't have to merge them when used
            $this->rules[ $scenario ] = new All($this->rules[ Validator::SCENARIO_ALL ]);
        }
        $this->rules[ $scenario ]->addRule($rule);
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

        return $rules->validate(
            $validator,
            $this->getValue($object),
            $forScenario
        );
    }

    /**
     * @param $forScenario
     *
     * @return CompositeRule
     */
    protected function getApplicableRules($forScenario)
    {
        if (!isset($this->rules[ $forScenario ])) {
            //fall back to 'all'
            $forScenario = Validator::SCENARIO_ALL;
        }

        return $this->rules[ $forScenario ];
    }

    protected abstract function getValue($object);

}