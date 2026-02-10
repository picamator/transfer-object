<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\WorkflowFactory;

class TransferGeneratorFactory
{
    use SharedFactoryTrait;

    public function __construct(
        private readonly WorkflowFactory $workflowFactory = new WorkflowFactory(),
    ) {
    }

    public function createTransferGeneratorFiber(): TransferGeneratorFiberInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferGeneratorFiber',
            factory: fn(): TransferGeneratorFiberInterface =>
                new TransferGeneratorFiber($this->createTransferGeneratorWorkflow()),
        );
    }

    public function createTransferGeneratorService(): TransferGeneratorServiceInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferGeneratorService',
            factory: fn(): TransferGeneratorServiceInterface =>
                new TransferGeneratorService($this->createTransferGeneratorWorkflow()),
        );
    }

    public function createTransferGeneratorBulkFiber(): TransferGeneratorBulkFiberInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferGeneratorBulkFiber',
            factory: fn(): TransferGeneratorBulkFiberInterface =>
                new TransferGeneratorBulkFiber(
                    $this->createFileReaderProgress(),
                    $this->createTransferGeneratorBulkBuilder(),
                    $this->createTransferGeneratorService(),
                ),
        );
    }

    protected function createTransferGeneratorBulkBuilder(): TransferGeneratorBulkBuilderInterface
    {
        return new TransferGeneratorBulkBuilder();
    }

    protected function createTransferGeneratorWorkflow(): TransferGeneratorWorkflowInterface
    {
        return $this->workflowFactory
            ->createTransferGeneratorWorkflow();
    }
}
