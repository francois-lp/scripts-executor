<?php

namespace Model\Service\ScriptsExecutor\Type;

use Model\Core\DesignPattern\AbstractSingleton;

final class PhpScriptsExecutor extends AbstractScriptsExecutor
{
    /** @var AbstractSingleton|null */
    protected static ?AbstractSingleton $instance = null;

    public function getCmd(): string
    {
        return 'php';
    }

    protected function getFolderName(): string
    {
        return 'php';
    }
}
