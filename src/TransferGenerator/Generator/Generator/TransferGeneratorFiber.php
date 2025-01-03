<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

readonly class TransferGeneratorFiber implements TransferGeneratorFiberInterface
{
    public function __construct(
        private TransferGeneratorInterface $transferGenerator,
    ) {
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        return new Fiber($this->getTransferFiberCallback(...));
    }

    private function getTransferFiberCallback(string $configPath): bool
    {
        $generator = $this->transferGenerator->generateTransfers($configPath);
        foreach ($generator as $generatorTransfer) {
            Fiber::suspend($generatorTransfer);
        }

        return $generator->getReturn();
    }
}
