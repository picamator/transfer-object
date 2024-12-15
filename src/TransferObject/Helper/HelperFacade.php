<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

readonly class HelperFacade implements HelperFacadeInterface
{
    public function generateTransfers(string $configPath): \ArrayObject
    {
        return new HelperFactory()
            ->createTransferGenerator()
            ->generateTransfers($configPath);
    }

    public function generateDefinitions(): bool
    {
        return new HelperFactory()
            ->createDefinitionGenerator()
            ->generateDefinitions();
    }
}
