[![Build Status](https://travis-ci.org/bugadani/Validatiny.svg?branch=master)](https://travis-ci.org/bugadani/Validatiny)

Validatiny
========
Validatiny is a simple PHP library used to validate objects against a set of rules.

Validatiny is licensed under the MIT license.

Rules
========
Validatiny uses subclasses of Validatiny\Rule to validate objects. The current subclasses are:
 * String - validates a string with optional length parameters
 * Pattern - validates a regexp pattern
 * Number - validates a numeric value with optional range parameters
 * Enum - validates against a list of values
 * Object - checks the object type and optionally validates the object as well
 * Union - validates against a list of Rules where at least one of the Rules must apply, useful for collections or optional rules
 * All - validates agains a list of Rules where all Rules must apply
 * more to come...

Validatiny can apply the Rules on public properties and getter methods. Any number of Rules may be set and all of them
 must be valid in order for the property and/or method to be considered valid. An object is considered valid if all of
 its properties and methods are valid.

To be continued...