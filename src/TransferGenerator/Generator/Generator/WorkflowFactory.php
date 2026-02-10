<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflow;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

class WorkflowFactory
{
    use SharedFactoryTrait;

    public function __construct(
        private readonly GeneratorFactory $generatorFactory = new GeneratorFactory(),
    ) {
    }

    public function createTransferGeneratorWorkflow(): TransferGeneratorWorkflowInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferGeneratorWorkflow',
            factory: fn(): TransferGeneratorWorkflowInterface =>
                new TransferGeneratorWorkflow($this->createGeneratorProcessor()),
        );
    }

    protected function createGeneratorProcessor(): GeneratorProcessorInterface
    {
        return $this->generatorFactory->createGeneratorProcessor();
    }
}
