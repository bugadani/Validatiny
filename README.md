[![Build Status](https://travis-ci.org/bugadani/Validatiny.svg?branch=master)](https://travis-ci.org/bugadani/Validatiny)

Validatiny
========
Validatiny is a simple PHP library used to validate objects against a set of rules.

Validatiny is licensed under the MIT license.

Rules
========
Validatiny uses subclasses of Validatiny\Rule to validate objects. The current subclasses are:
 * All - validates against a list of Rules where all Rules must apply
 * Boolean - accepts only true or false
 * Callable - accepts callable values
 * Callback - calls a function or static method to validate the value
 * CollectionOf - validates a collection of elements against a single rule (e.g. validates is something is an array of numbers)
 * Enum - validates against a list of values
 * Not - negates the result of the inner validator
 * Number - validates a numeric value with optional range parameters
 * Object - checks the object type and optionally validates the object as well
 * Optional - accepts null or validates using an inner rule
 * Pattern - validates a regexp pattern
 * String - validates a string with optional length parameters
 * Union - validates against a list of Rules where at least one of the Rules must apply, useful for collections or optional rules
 * more to come...

Validatiny can apply the Rules on public properties and getter methods. Any number of Rules may be set and all of them
 must be valid in order for the property and/or method to be considered valid. An object is considered valid if all of
 its properties and methods are valid.

Validation scenarios
========
Rules can be added to specific validation scenarios. This enables the user to specify multiple sets of rules on
a single object.

To specify which rule should belong to which scenario, use the `scenario: 'scenarioName'` attribute on the rule
annotation, or call `$rule->setScenario()`. Both of these accept a single name or an array of scenario names.

By default, Validatiny validates all rules on an object. To override this behaviour, pass the name of the validation
scenario as the second parameter for `Validator::validate`.

To be continued...