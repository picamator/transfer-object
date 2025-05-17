<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigProxy;

trait ConfigFactoryTrait
{
    final protected function getConfig(): ConfigInterface
    {
        return new ConfigProxy();
    }
}
