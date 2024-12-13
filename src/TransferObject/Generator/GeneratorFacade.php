<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Closure;

readonly class GeneratorFacade implements GeneratorFacadeInterface
{
    public function generateTransfers(Closure $errorItemCallback): bool
    {
        return new GeneratorFactory()
            ->createGeneratorFiber()
            ->generateTransfers($errorItemCallback);
    }
}
