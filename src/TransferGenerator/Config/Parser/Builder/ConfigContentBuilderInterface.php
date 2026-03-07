<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

interface ConfigContentBuilderInterface
{
    /**
     * @param array<string, string|bool|null> $configData
     */
    public function createContentTransfer(array $configData): ConfigContentTransfer;
}
