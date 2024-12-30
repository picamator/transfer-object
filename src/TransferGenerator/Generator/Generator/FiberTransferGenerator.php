<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\Command\Helper\ProgressBarInterface;

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
    public function getTransferFiberCallback(ProgressBarInterface $progressBar): bool
    {
        $progressBar->progressStart($this->generator->getDefinitionFileCount());
        $generatorIterator = $this->generator->getTransferGenerator();

        $currentDefinitionFile = '';
        foreach ($generatorIterator as $generatorTransfer) {
            if ($currentDefinitionFile !== $generatorTransfer->fileName) {
                $currentDefinitionFile = $generatorTransfer->fileName;
                $progressBar->progressAdvance();
            }

            Fiber::suspend($generatorTransfer);
        }

        $progressBar->progressFinish();

        return $generatorIterator->getReturn();
    }
}
