<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Environment;

interface EnvironmentReaderInterface
{
    public function getProjectRoot(): string;

    public function getMaxFileSizeMegabytes(): int;

    public function getMaxFileSizeBytes(): int;
}
