<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

trait ConfigTrait
{
    protected function getConfig(): ConfigInterface
    {
        return ConfigContainer::getConfig();
    }
}
