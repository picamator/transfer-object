<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

interface ConfigContentBuilderInterface
{
    /**
     * @param array<string,mixed> $configData
     */
    public function createContentTransfer(array $configData): ConfigContentTransfer;
}
