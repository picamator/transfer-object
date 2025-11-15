<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use NoDiscard;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\DefinitionGeneratorFactory;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

class DefinitionGeneratorFacade implements DefinitionGeneratorFacadeInterface
{
    private static DefinitionGeneratorFactory $factory;

    #[NoDiscard('The result should be used to validate how many definitions were generated.')]
    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        return $this->getFactory()
            ->createDefinitionGeneratorService()
            ->generateDefinitionsOrFail($generatorTransfer);
    }

    #[NoDiscard('The builder should be used to create DefinitionGeneratorTransfer.')]
    public function createDefinitionGeneratorBuilder(): DefinitionGeneratorBuilderInterface
    {
        return $this->getFactory()
            ->createDefinitionGeneratorBuilder();
    }

    private function getFactory(): DefinitionGeneratorFactory
    {
        return self::$factory ??= new DefinitionGeneratorFactory();
    }
}
