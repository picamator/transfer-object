<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Generator;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;

readonly class BulkProcessCommand implements BulkProcessCommandInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private ProcessCommandInterface $processCommand,
    ) {
    }

    public function process(): Generator
    {
        $failedCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processCommand->process($definitionTransfer);
            if (!$generatorTransfer->validator->isValid) {
                $failedCount++;
            }

            yield $generatorTransfer;
        }

        return $definitionGenerator->getReturn() > 0 && $failedCount === 0;
    }
}
