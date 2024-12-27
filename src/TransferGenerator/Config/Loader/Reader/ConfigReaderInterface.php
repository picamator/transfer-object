<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Reader;

use Picamator\TransferObject\Generated\ConfigTransfer;

interface ConfigReaderInterface
{
    public function getConfig(string $configPath): ConfigTransfer;
}
