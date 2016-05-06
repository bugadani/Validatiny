<?php

namespace Validatiny;

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
     * @param $forScenario
     *
     * @return Rule[]
     */
    protected function getApplicableRules($forScenario)
    {
        $rules = $this->rules[ Validator::SCENARIO_ALL ];
        if ($forScenario !== Validator::SCENARIO_ALL && isset($this->rules[ $forScenario ])) {
            $rules = array_merge($rules, $this->rules[ $forScenario ]);
        }

        return $rules;
    }
}