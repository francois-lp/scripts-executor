<?php

namespace Model\Service\ScriptsExecutor;

use Model\Service\ScriptsExecutor\ScriptsExecutorFactory;
use Model\Service\ScriptsExecutor\Type\AbstractScriptsExecutor;

/**
 * Main class using factory class and execute scripts
 */
final class ScriptsExecutor
{
    protected array $scriptsToExecute = [];

    protected ?ScriptsExecutorFactory $scriptsExecutorFactory = null;

    public function __construct(array $scriptsToExecute)
    {
        $this->setScriptsToExecute($scriptsToExecute);
    }

    /**
     * Checks and set scripts to execute
     *
     * @param array $scripts
     * @throws Exception
     * @return void
     */
    private function setScriptsToExecute(array $scriptsToExecute): void
    {
        if (!empty($scriptsToExecute)) {
            $this->scriptsToExecute = $scriptsToExecute;
        } else {
            throw new \Exception('Scripts list can not be empty');
        }
    }

    /**
     * Execute the scripts via the corresponding executor (created by the factory) 
     *
     * @return void
     */
    public function executeScripts(): void
    {
        foreach ($this->scriptsToExecute as $script) {
            sleep(2);
            /** @var AbstractScriptsExecutor $scriptsExecutor */
            $scriptsExecutor = $this->getScriptsExecutorFactory()->create($script);
            $scriptsExecutor->setScripts([$script]);
            $scriptsExecutor->executeScripts();
        }
    }

    /**
     * Returns a ScriptsExecutorFactory instance
     *
     * @return ScriptsExecutorFactory
     */
    private function getScriptsExecutorFactory(): ScriptsExecutorFactory
    {
        if (empty($this->scriptsExecutorFactory)) {
            $this->scriptsExecutorFactory = new ScriptsExecutorFactory();
        }
        return $this->scriptsExecutorFactory;
    }
}
