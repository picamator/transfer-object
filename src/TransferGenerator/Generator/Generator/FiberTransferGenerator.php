<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

readonly class FiberTransferGenerator implements FiberTransferGeneratorInterface
{
    public function __construct(
        private TransferGeneratorInterface $transferGenerator,
    ) {
    }

    public function getTransferFiberCallback(string $configPath): bool
    {
        $transferGenerator = $this->transferGenerator->getTransferGenerator($configPath);
        foreach ($transferGenerator as $generatorTransfer) {
            Fiber::suspend($generatorTransfer);
        }

        return $transferGenerator->getReturn();
    }
}
