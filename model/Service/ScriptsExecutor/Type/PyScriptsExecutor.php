<?php

namespace Model\Service\ScriptsExecutor\Type;

use Model\Core\DesignPattern\AbstractSingleton;

final class PyScriptsExecutor extends AbstractScriptsExecutor
{
    /** @var AbstractSingleton|null */
    protected static ?AbstractSingleton $instance = null;

    public function getCmd(): string
    {
        return 'python -B';
    }

    protected function getFolderName(): string
    {
        return 'python';
    }

    protected function executeScript($script): string|false|null
    {
        $command_exec = escapeshellcmd($this->getCmd() . ' ' . $script);
        return shell_exec($command_exec);
    }
}
