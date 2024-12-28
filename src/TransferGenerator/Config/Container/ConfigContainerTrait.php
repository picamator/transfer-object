<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Container;

trait ConfigContainerTrait
{
    protected function getConfig(): ConfigInterface
    {
        return ConfigContainer::getConfig();
    }
}
