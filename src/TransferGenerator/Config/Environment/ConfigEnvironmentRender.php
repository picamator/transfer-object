<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Environment;

class ConfigEnvironmentRender implements ConfigEnvironmentRenderInterface
{
    protected const string PLACEHOLDER = '${PROJECT_ROOT}';
    protected const string ENVIRONMENT_KEY = 'PROJECT_ROOT';

    private string $projectRootCache;

    public function renderProjectRoot(string $path): string
    {
        $projectRoot = $this->getProjectRoot();
        $path = $this->rtrimPath($path);

        return str_replace(static::PLACEHOLDER, $projectRoot, $path);
    }

    public function renderRelativeProjectRoot(string $path): string
    {
        $path = $this->rtrimPath($path);

        return str_replace(static::PLACEHOLDER, '', $path);
    }

    private function getProjectRoot(): string
    {
        if (isset($this->projectRootCache)) {
            return $this->projectRootCache;
        }

        $projectRoot = $this->getEnvironment() ?: $this->getWorkingDir();

        return $this->projectRootCache = $projectRoot;
    }

    private function getWorkingDir(): string
    {
        return $this->getcwd() ?: '';
    }

    protected function getcwd(): false|string
    {
        return getcwd();
    }

    private function getEnvironment(): string
    {
        $envValue = $this->getenv(static::ENVIRONMENT_KEY);
        if (!is_string($envValue)) {
            return '';
        }

        return $envValue
            |> trim(...)
            |> $this->rtrimPath(...);
    }

    /**
     * @return array<int, string>|false|string
     */
    protected function getenv(string $name): array|false|string
    {
        return getenv($name);
    }

    private function rtrimPath(string $path): string
    {
        return rtrim($path, '\/');
    }
}
