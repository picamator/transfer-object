<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

trait TransferGeneratorFacadeTrait
{
    /**
     * @throws \Throwable
     */
    protected function generateTransfers(callable $postGenerateItemCallback): bool
    {
        $generatorFiber = new TransferGeneratorFacade()->getTransferGeneratorFiber();

        $generatorFiber->start();
        while (!$generatorFiber->isTerminated()) {
            /** @var \Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer|null $generatorTransfer */
            $generatorTransfer = $generatorFiber->resume();
            $postGenerateItemCallback($generatorTransfer);
        }

        return $generatorFiber->getReturn();
    }
}
