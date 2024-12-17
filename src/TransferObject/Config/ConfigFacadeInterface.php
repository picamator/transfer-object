<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

use Picamator\TransferObject\Transfer\Generated\ConfigValidatorTransfer;

interface ConfigFacadeInterface
{
    public function loadConfig(string $configPath): ConfigValidatorTransfer;
}
