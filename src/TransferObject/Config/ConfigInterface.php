<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

interface ConfigInterface
{
    public function getTransferNamespace(): string;

    public function getTransferPath(): string;

    public function getDefinitionPath(): string;
}
