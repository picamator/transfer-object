<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Picamator\TransferObject\Shared\SharedFactoryTrait;

trait DefinitionGeneratorHelperTrait
{
    use SharedFactoryTrait;

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     */
    final protected function createDefinitionGenerator(
        string $definitionPath,
        string $className,
        string $sampleJsonPath,
    ): DefinitionGeneratorTransfer {
        $builder = new DefinitionGeneratorFacade()->createDefinitionGeneratorBuilder();

        return $builder
            ->setDefinitionPath($definitionPath)
            ->setClassName($className)
            ->setJsonPath($sampleJsonPath)
            ->build();
    }

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\JsonReaderException
     *
     * @return array<string,mixed>
     */
    final protected function getSampleContent(string $sampleJsonPath): array
    {
        return $this->createJsonReader()->getJsonContent($sampleJsonPath);
    }
}
