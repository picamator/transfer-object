<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator;

use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

readonly class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    public function generateTransfers(callable $handleCallback): bool
    {
        return new TransferGeneratorFactory()
            ->createTransferGenerator()
            ->generateTransfers($handleCallback);
    }
}
