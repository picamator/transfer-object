<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

readonly class TransferGeneratorFiber implements TransferGeneratorFiberInterface
{
    public function __construct(
        private TransferGeneratorWorkflowInterface $workflow,
    ) {
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        /** @var \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorTransfer> $fiber */
        $fiber = new Fiber($this->getTransferFiberCallback(...));

        return $fiber;
    }

    private function getTransferFiberCallback(string $configPath): bool
    {
        $generator = $this->workflow->generateTransfers($configPath);
        foreach ($generator as $generatorTransfer) {
            Fiber::suspend($generatorTransfer);
        }

        /** @var bool $generatorReturn */
        $generatorReturn = $generator->getReturn();

        return $generatorReturn;
    }
}
