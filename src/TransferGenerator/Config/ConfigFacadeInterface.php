<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ConfigFacadeInterface
{
    public function loadConfig(string $configPath): ValidatorMessageTransfer;
}
