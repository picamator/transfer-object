<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Render;

interface ProjectRootRenderInterface
{
    public function renderProjectRoot(string $path): string;

    public function renderRelativeProjectRoot(string $path): string;
}
