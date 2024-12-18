<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Fiber;

readonly class GeneratorFacade implements GeneratorFacadeInterface
{
    public function getGeneratorFiber(): Fiber
    {
        return new GeneratorFactory()
            ->createGeneratorFiber();
    }
}
