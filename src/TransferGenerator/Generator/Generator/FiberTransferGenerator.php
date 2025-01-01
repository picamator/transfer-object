<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Throwable;

readonly class FiberTransferGenerator implements FiberTransferGeneratorInterface
{
    public function __construct(
        private TransferGeneratorInterface $generator,
    ) {
    }

    public function getTransferFiberCallback(): bool
    {
        $transferGenerator = $this->generator->getTransferGenerator();
        foreach ($transferGenerator as $generatorTransfer) {
            try {
                Fiber::suspend($generatorTransfer);
            } catch (Throwable $e) {
                $transferGenerator->throw($e);
            }
        }

        return $transferGenerator->getReturn();
    }
}
