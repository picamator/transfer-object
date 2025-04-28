<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Environment;

interface ConfigEnvironmentRenderInterface
{
    public function renderProjectRoot(string $path): string;

    public function renderRelativeProjectRoot(string $path): string;
}
