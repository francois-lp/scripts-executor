<?php

// link : https://stackoverflow.com/questions/1818765/extend-abstract-singleton-class
// link : https://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html

namespace Model\Core\DesignPattern;

use Exception;

abstract class AbstractSingleton
{
    /** @var AbstractSingleton|null */
    protected static ?AbstractSingleton $instance = null;

    /**
     * Gets the instance via lazy initialization (created on first usage)
     *
     * @return AbstractSingleton
     */
    final public static function getInstance(): AbstractSingleton
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Prevent from creating multiple instances, is not allowed to call from outside 
     * To use the singleton, you have to obtain the instance from AbstractSingleton::getInstance() instead
     */
    final protected function __construct()
    {
    }

    /**
     * Prevent the instance from being cloned (which would create a second instance of it)
     */
    final protected function __clone()
    {
    }

    /**
     * Prevent from being unserialized (which would create a second instance of it)
     * 
     * @throws Exception
     */
    final public function __wakeup()
    {
        throw new Exception('Cannot unserialize singleton');
    }
}
