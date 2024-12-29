<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Environment;

class ConfigEnvironmentRender implements ConfigEnvironmentRenderInterface
{
    private const string PROJECT_ROOT_PLACEHOLDER = '${PROJECT_ROOT}';
    private const string PROJECT_ROOT_ENV = 'PROJECT_ROOT';

    private static string $projectRoot;

    public function renderProjectRoot(string $path): string
    {
        $projectRoot = $this->getProjectRoot();

        return str_replace(self::PROJECT_ROOT_PLACEHOLDER, $projectRoot, $path,);
    }

    private function getProjectRoot(): string
    {
        self::$projectRoot = getenv(self::PROJECT_ROOT_ENV) ?: '';

        return self::$projectRoot;
    }
}
