<?php

namespace Model\Service\ScriptsExecutor;

use Model\Core\DesignPattern\AbstractFactory;

/**
 * Class used to build instances of scripts executors
 */
final class ScriptsExecutorFactory extends AbstractFactory
{
    const INSTANCE_CLASS_NAMESPACE = '\Model\Service\ScriptsExecutor\Type\\';
    const INSTANCE_CLASS_SUFFIX = 'ScriptsExecutor';

    /**
     * Compute instance class
     *
     * @param string $inputCreation
     * @return string
     */
    protected function computeInstanceClass(string $inputCreation): string
    {
        // the variable $inputCreation corresponds to the script to be executed
        $scriptExtension = pathinfo($inputCreation, PATHINFO_EXTENSION);

        $classNamespace = self::INSTANCE_CLASS_NAMESPACE;
        $classPrefix = ucfirst($scriptExtension);
        $classSuffix = self::INSTANCE_CLASS_SUFFIX;

        return "{$classNamespace}{$classPrefix}{$classSuffix}";
    }
}
