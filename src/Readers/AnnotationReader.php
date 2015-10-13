<?php

namespace Validatiny\Readers;

use Annotiny\Comment;
use Validatiny\ObjectValidator;
use Validatiny\Rule;
use Validatiny\RuleReader;

class AnnotationReader extends RuleReader
{
    /**
     * @var \Annotiny\AnnotationReader
     */
    private $annotationReader;

    public function __construct(\Annotiny\AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param string|object $object Class name or object instance
     *
     * @return ObjectValidator
     */
    public function getObjectValidator($object)
    {
        $validator = new ObjectValidator();

        $classComment = $this->annotationReader->readClass($object);
        foreach ($classComment->getAnnotations() as $class => $annotations) {
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Rule) {
                    $validator->addRule($annotation);
                }
            }
        }

        $methods = $this->annotationReader->readMethods($object);
        foreach ($methods as $methodName => $comment) {
            /** @var Comment $comment */
            foreach ($comment->getAnnotations() as $class => $annotations) {
                foreach ($annotations as $annotation) {
                    if ($annotation instanceof Rule) {
                        $validator->addMethodRule($methodName, $annotation);
                    }
                }
            }
        }

        $properties = $this->annotationReader->readProperties($object);
        foreach ($properties as $propertyName => $comment) {
            /** @var Comment $comment */
            foreach ($comment->getAnnotations() as $class => $annotations) {
                foreach ($annotations as $annotation) {
                    if ($annotation instanceof Rule) {
                        $validator->addPropertyRule($propertyName, $annotation);
                    }
                }
            }
        }

        return $validator;
    }
}