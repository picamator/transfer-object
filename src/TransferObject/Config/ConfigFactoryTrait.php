<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

use Picamator\TransferObject\Config\Container\ConfigContainer;
use Picamator\TransferObject\Config\Container\ConfigInterface;

trait ConfigFactoryTrait
{
    protected function getConfig(): ConfigInterface
    {
        return ConfigContainer::getConfig();
    }
}
