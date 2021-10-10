<?php

namespace Model\Service\ScriptsExecutor\Type;

use Model\Core\DesignPattern\AbstractSingleton;

abstract class AbstractScriptsExecutor extends AbstractSingleton
{
    const SCRIPTS_FOLDER_ROOT = 'scripts';
    const SCRIPTS_FOLDER_SOURCES = 'src';
    const SCRIPTS_FOLDER_OUPUT = 'output';

    protected string $cmd = '';
    protected array $scripts = [];

    abstract public function getCmd(): string;
    abstract protected function getFolderName(): string;

    /**
     * Set and checks scripts list to execute
     *
     * @param array $scripts
     * @throws Exception
     * @return void
     */
    final public function setScripts(array $scripts): void
    {
        if (!empty($scripts)) {
            $this->scripts = $this->getCheckedScriptsSourceFiles($scripts);
        } else {
            throw new \Exception('Scripts list can not be empty');
        }
    }

    private function getCheckedScriptsSourceFiles(array $scripts): array
    {
        $checkedScripts = [];
        foreach ($scripts as $script) {
            $scriptSourcePath = $this->computeScriptSourceAbsolutePath($script);
            if (is_readable($scriptSourcePath)) {
                $checkedScripts[] = $scriptSourcePath;
            }
        }
        return $checkedScripts;
    }

    private function computeScriptSourceAbsolutePath(string $script): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            getcwd(),
            self::SCRIPTS_FOLDER_ROOT,
            self::SCRIPTS_FOLDER_SOURCES,
            $this->getFolderName(),
            $script
        ]);
    }

    final protected function computeScriptOutputPath(): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            self::SCRIPTS_FOLDER_ROOT,
            self::SCRIPTS_FOLDER_OUPUT,
            $this->getFolderName()
        ]);
    }

    /**
     * Execute scripts list
     *
     * @return void
     */
    final public function executeScripts(): void
    {
        foreach ($this->scripts as $script) {

            // execution starting
            $this->displayLogMessage('Execution of script "' . $script . '" starting');

            // execution
            $str_output = $this->executeScript($script);

            // execution completed
            $this->displayLogMessage('Result : "' . $str_output);
            $this->displayLogMessage('Execution of script "' . $script . '" completed<br />');
            ob_flush();
            flush();
        }
    }

    final protected function displayLogMessage(string $message): void
    {
        echo '<br />' . date('Y-m-d H:i:s') . ' - ' . $message;
    }

    /**
     * Execute a script (can be overwritten by a child class)
     *
     * @param string $script
     * @return string|false|null
     */
    protected function executeScript(string $script): string|false|null
    {
        return exec(escapeshellcmd($this->getCmd() . ' ' . $script . ' ' . $this->getExecuteOptions()));
    }

    /**
     * Get execution options (can be overwritten by a child class)
     *
     * @param string $script
     * @return string|false|null
     */
    protected function getExecuteOptions(): string
    {
        return implode(' ', [
            '--outputFolderPath="' . $this->computeScriptOutputPath() . '"'
        ]);
    }
}
