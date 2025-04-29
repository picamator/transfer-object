<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Environment;

class ConfigEnvironmentRender implements ConfigEnvironmentRenderInterface
{
    private const string PLACEHOLDER = '${PROJECT_ROOT}';
    private const string ENVIRONMENT_KEY = 'PROJECT_ROOT';

    private string $projectRootCache;

    public function renderProjectRoot(string $path): string
    {
        $projectRoot = $this->getProjectRoot();
        $path = rtrim($path, '\/');

        return str_replace(self::PLACEHOLDER, $projectRoot, $path);
    }

    public function renderRelativeProjectRoot(string $path): string
    {
        return str_replace(self::PLACEHOLDER, '', $path);
    }

    private function getProjectRoot(): string
    {
        if (isset($this->projectRootCache)) {
            return $this->projectRootCache;
        }

        $projectRoot = $this->getEnvironment() ?: $this->getWorkingDir();

        return $this->projectRootCache = $projectRoot;
    }

    protected function getWorkingDir(): string
    {
        return getcwd() ?: '';
    }

    protected function getEnvironment(): string
    {
        $envValue = getenv(self::ENVIRONMENT_KEY);
        if (!is_string($envValue)) {
            return '';
        }

        $envValue = trim($envValue);

        return rtrim($envValue, '\/');
    }
}
