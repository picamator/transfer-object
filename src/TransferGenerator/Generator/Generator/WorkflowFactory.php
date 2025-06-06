<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflow;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

class WorkflowFactory
{
    use SharedFactoryTrait;
    use CachedFactoryTrait;

    private static GeneratorFactory $generatorFactory;

    public function createTransferGeneratorWorkflow(): TransferGeneratorWorkflowInterface
    {
        return $this->getCached(
            key: 'generator-workflow',
            factory: fn (): TransferGeneratorWorkflowInterface =>
                new TransferGeneratorWorkflow(
                    $this->createGeneratorProcessor(),
                ),
        );
    }

    protected function createGeneratorProcessor(): GeneratorProcessorInterface
    {
        return $this->getGeneratorFactory()->createGeneratorProcessor();
    }

    protected function getGeneratorFactory(): GeneratorFactory
    {
        return self::$generatorFactory ??= new GeneratorFactory();
    }
}
