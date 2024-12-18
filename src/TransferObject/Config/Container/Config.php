<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config\Container;

final readonly class Config implements ConfigInterface
{
    public function __construct(
        private string $transferNamespace,
        private string $transferPath,
        private string $definitionPath,
    ) {
    }

    public function getTransferNamespace(): string
    {
        return $this->transferNamespace;
    }

    public function getTransferPath(): string
    {
        return $this->transferPath;
    }

    public function getDefinitionPath(): string
    {
        return $this->definitionPath;
    }
}
