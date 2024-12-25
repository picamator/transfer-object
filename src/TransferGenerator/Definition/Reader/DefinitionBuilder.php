<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\PropertyExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ContentValidatorInterface;

readonly class DefinitionBuilder implements DefinitionBuilderInterface
{
    /**
     * @param \ArrayObject<int,PropertyExpanderInterface> $propertyExpanders
     */
    public function __construct(
        private ContentValidatorInterface $validator,
        private ArrayObject $propertyExpanders,
    ) {
    }

    public function buildDefinitionTransfer(string $className, array $properties): DefinitionTransfer
    {
        $contentTransfer = $this->createContentTransfer($className, $properties);
        $validatorTransfer = $this->validator->validate($contentTransfer);

        $definitionTransfer = new DefinitionTransfer();
        $definitionTransfer->content = $contentTransfer;
        $definitionTransfer->validator = $validatorTransfer;

        return $definitionTransfer;
    }

    /**
     * @param array<string|int, array<string, string|null>> $properties
     */
    private function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;

        foreach ($properties as $propertyName => $propertyType) {
            /** @var array<string,string|bool> $propertyType */
            $propertyType = array_filter($propertyType ?: [], $this->propertyTypeFilter(...));

            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = (string)$propertyName;
            $this->handlePropertyExpanders($propertyType, $propertyTransfer);

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function handlePropertyExpanders(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        foreach ($this->propertyExpanders as $propertyExpander) {
            if (!$propertyExpander->isApplicable($propertyType)) {
                continue;
            }

            $propertyExpander->expandPropertyTransfer($propertyType, $propertyTransfer);

            return;
        }
    }

    private function propertyTypeFilter(mixed $typeItem): bool
    {
        return is_string($typeItem) || is_bool($typeItem);
    }
}
