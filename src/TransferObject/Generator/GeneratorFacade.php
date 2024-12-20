<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

readonly class GeneratorFacade implements GeneratorFacadeInterface
{
    public function generateTransfers(callable $handleCallback): bool
    {
        return new GeneratorFactory()
            ->createTransferGenerator()
            ->generateTransfers($handleCallback);
    }
}
