<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

readonly class FiberTransferGenerator implements FiberTransferGeneratorInterface
{
    public function __construct(
        private TransferGeneratorInterface $generator,
    ) {
    }

    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    public function getTransferFiberCallback(): bool
    {
        $generatorIterator = $this->generator->getTransferGenerator();

        $currentDefinitionFile = '';
        foreach ($generatorIterator as $generatorTransfer) {
            if ($currentDefinitionFile !== $generatorTransfer->fileName) {
                $currentDefinitionFile = $generatorTransfer->fileName;
            }

            Fiber::suspend($generatorTransfer);
        }

        return $generatorIterator->getReturn();
    }
}
