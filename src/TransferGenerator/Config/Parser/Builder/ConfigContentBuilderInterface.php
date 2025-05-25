<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

interface ConfigContentBuilderInterface
{
    public function createDefaultContentTransfer(): ConfigContentTransfer;

    /**
     * @param array<string, string|null> $configData
     */
    public function createContentTransfer(array $configData): ConfigContentTransfer;
}
