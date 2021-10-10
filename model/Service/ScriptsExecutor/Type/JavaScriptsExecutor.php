<?php

namespace Model\Service\ScriptsExecutor\Type;

use Model\Core\DesignPattern\AbstractSingleton;

final class JavaScriptsExecutor extends AbstractScriptsExecutor
{
    /** @var AbstractSingleton|null */
    protected static ?AbstractSingleton $instance = null;

    public function getCmd(): string
    {
        return 'java';
    }

    protected function getFolderName(): string
    {
        return 'java';
    }
}
