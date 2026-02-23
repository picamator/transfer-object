<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Render;

use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;

readonly class ProjectRootRender implements ProjectRootRenderInterface
{
    protected const string PLACEHOLDER = '${PROJECT_ROOT}';

    public function __construct(private EnvironmentReaderInterface $environmentReader)
    {
    }

    public function renderProjectRoot(string $path): string
    {
        $projectRoot = $this->environmentReader->getProjectRoot();

        return str_replace(static::PLACEHOLDER, $projectRoot, $path);
    }

    public function renderRelativeProjectRoot(string $path): string
    {
        $path = rtrim($path, '\/');

        return str_replace(static::PLACEHOLDER, '', $path);
    }
}
