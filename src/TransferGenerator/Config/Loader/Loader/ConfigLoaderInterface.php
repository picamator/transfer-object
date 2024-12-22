<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Loader;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ConfigLoaderInterface
{
    public function loadConfig(string $configPath): ValidatorMessageTransfer;
}
