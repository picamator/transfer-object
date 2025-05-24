<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\GeneratorFactory;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflow;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

class TransferGeneratorFactory
{
    use SharedFactoryTrait;
    use CachedFactoryTrait;

    public function createTransferGeneratorFiber(): TransferGeneratorFiberInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'transfer-generator-fiber',
            factory: fn (): TransferGeneratorFiberInterface =>
                new TransferGeneratorFiber(
                    $this->createTransferGeneratorWorkflow(),
                ),
        );
    }

    public function createTransferGeneratorWorkflow(): TransferGeneratorWorkflowInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'generator-workflow',
            factory: fn (): TransferGeneratorWorkflowInterface =>
                new TransferGeneratorWorkflow(
                    $this->createGeneratorProcessor(),
                ),
        );
    }

    public function createTransferGeneratorService(): TransferGeneratorServiceInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'transfer-generator-service',
            factory: fn (): TransferGeneratorServiceInterface =>
                new TransferGeneratorService(
                    $this->createTransferGeneratorWorkflow(),
                ),
        );
    }

    public function createTransferGeneratorBulkFiber(): TransferGeneratorBulkFiberInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'transfer-generator-bulk-fiber',
            factory: fn (): TransferGeneratorBulkFiberInterface =>
                new TransferGeneratorBulkFiber(
                    $this->createFileReaderProgress(),
                    $this->createTransferGeneratorBulkBuilder(),
                    $this->createTransferGeneratorService(),
                ),
        );
    }

    protected function createTransferGeneratorBulkBuilder(): TransferGeneratorBulkBuilderInterface
    {
        return new GeneratorFactory()->createTransferGeneratorBulkBuilder();
    }

    protected function createGeneratorProcessor(): GeneratorProcessorInterface
    {
        return new GeneratorFactory()->createGeneratorProcessor();
    }
}
