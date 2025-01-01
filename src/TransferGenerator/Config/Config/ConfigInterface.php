<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Config;

interface ConfigInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    public function getTransferNamespace(): string;

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    public function getTransferPath(): string;

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    public function getDefinitionPath(): string;
}
