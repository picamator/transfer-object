<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Environment;

class ConfigEnvironmentRender implements ConfigEnvironmentRenderInterface
{
    private const string PROJECT_ROOT_PLACEHOLDER = '${PROJECT_ROOT}';
    private const string PROJECT_ROOT_ENV = 'PROJECT_ROOT';

    private string $projectRootCache;

    public function renderProjectRoot(string $path): string
    {
        $projectRoot = $this->getProjectRoot();

        return str_replace(self::PROJECT_ROOT_PLACEHOLDER, $projectRoot, $path);
    }

    public function renderRelativeProjectRoot(string $path): string
    {
        return str_replace(self::PROJECT_ROOT_PLACEHOLDER, '', $path);
    }

    private function getProjectRoot(): string
    {
        if (isset($this->projectRootCache)) {
            return $this->projectRootCache;
        }

        $projectRoot = $this->getEnv(self::PROJECT_ROOT_ENV) ?: $this->getCwd();

        return $this->projectRootCache = $projectRoot;
    }

    protected function getCwd(): string
    {
        return getcwd() ?: '';
    }

    protected function getEnv(string $name): string
    {
        $envValue = getenv($name);

        return is_string($envValue) ? trim($envValue) : '';
    }
}
