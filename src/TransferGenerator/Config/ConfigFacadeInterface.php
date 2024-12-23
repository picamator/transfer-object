<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ConfigFacadeInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function loadConfig(string $configPath): ValidatorMessageTransfer;
}
