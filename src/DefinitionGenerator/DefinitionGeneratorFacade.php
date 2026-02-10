<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use NoDiscard;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\DefinitionGeneratorFactory;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGeneratorFacade implements DefinitionGeneratorFacadeInterface
{
    public function __construct(
        private DefinitionGeneratorFactory $factory = new DefinitionGeneratorFactory(),
    ) {
    }

    #[NoDiscard('The result should be used to validate how many definitions were generated.')]
    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        return $this->factory
            ->createDefinitionGeneratorService()
            ->generateDefinitionsOrFail($generatorTransfer);
    }

    #[NoDiscard('The builder should be used to create DefinitionGeneratorTransfer.')]
    public function createDefinitionGeneratorBuilder(): DefinitionGeneratorBuilderInterface
    {
        return $this->factory
            ->createDefinitionGeneratorBuilder();
    }
}
