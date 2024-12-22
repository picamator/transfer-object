<?php declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainer;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;

trait ConfigFactoryTrait
{
    protected function getConfig(): ConfigInterface
    {
        return ConfigContainer::getConfig();
    }
}
