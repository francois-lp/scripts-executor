<?php

namespace Model\Core\DesignPattern;

/**
 * Class used to build instances
 */
abstract class AbstractFactory
{

    private const GET_INSTANCE_METHOD = 'getInstance';

    /**
     * Create an instance corresponding to the computed instance class
     *
     * @param string $inputCreation
     * @return \stdClass
     */
    final public function create(string $inputCreation)
    {
        $class = $this->computeInstanceClass($inputCreation);

        if (method_exists($class, self::GET_INSTANCE_METHOD)) {
            $instance = $class::getInstance();
        } else {
            $instance = new $class();
        }
        return $instance;
    }

    /**
     * Returns the instance class full name to instantiate
     * Method can be overwritten by a child class to compute instance class full name corresponding to the param $inputCreation
     *
     * @param string $inputCreation
     * @return string
     */
    protected function computeInstanceClass(string $inputCreation): string
    {
        // case where the param $inputCreation is the instance class full name
        return $inputCreation;
    }
}
