<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\DefinitionGeneratorFactory;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

class DefinitionGeneratorFacade implements DefinitionGeneratorFacadeInterface
{
    private static DefinitionGeneratorFactory $factory;

    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        return $this->getFactory()
            ->createDefinitionGeneratorService()
            ->generateDefinitionsOrFail($generatorTransfer);
    }

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
