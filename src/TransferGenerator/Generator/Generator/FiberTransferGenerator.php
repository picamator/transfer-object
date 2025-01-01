<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Throwable;

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
            try {
                Fiber::suspend($generatorTransfer);
            } catch (Throwable $e) {
                $transferGenerator->throw($e);
            }
        }

        return $transferGenerator->getReturn();
    }
}
