<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Config;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

final readonly class Config implements ConfigInterface
{
    public function __construct(
        private ConfigContentTransfer $configTransfer,
    ) {
    }

    public function getTransferNamespace(): string
    {
        return $this->configTransfer->transferNamespace;
    }

    public function getTransferPath(): string
    {
        return $this->configTransfer->transferPath;
    }

    public function getDefinitionPath(): string
    {
        return $this->configTransfer->definitionPath;
    }

    public function getRelativeDefinitionPath(): string
    {
        return $this->configTransfer->relativeDefinitionPath;
    }

    public function getUuid(): string
    {
        return $this->configTransfer->uuid;
    }
}
