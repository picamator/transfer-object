<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Builder;

use ArrayObject;
use Generator;
use Picamator\TransferObject\Definition\Enum\TypeValueEnum;
use Picamator\TransferObject\Exception\HelperTransferException;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperContentTransfer;

readonly class DefinitionBuilder implements DefinitionBuilderInterface
{
    use DefinitionBuilderTrait;

    public function buildDefinitionContents(HelperContentTransfer $helperContentTransfer): Generator
    {
        $definitionGenerator = $this->getDefinition($helperContentTransfer);
        foreach ($definitionGenerator as $definitionTransfer) {
            yield $definitionTransfer;
        }

        /** @var \ArrayObject<\Picamator\TransferObject\Transfer\Generated\HelperContentTransfer> $helperContentTransfers */
        $helperContentTransfers = $definitionGenerator->getReturn();
        foreach ($helperContentTransfers as $helperContentTransfer) {
            yield from $this->buildDefinitionContents($helperContentTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     *
     * @return \Generator<\Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer>
     */
    private function getDefinition(HelperContentTransfer $helperContentTransfer): Generator
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $helperContentTransfer->className;

        $helperContentTransfers = new ArrayObject();
        foreach ($helperContentTransfer->content as $propertyName => $propertyValue) {
            $this->assertProperty($propertyName);

            if ($this->isTransfer($propertyValue)) {
                $propertyTransfer = $this->createTransferTypePropertyTransfer($propertyName);
                $contentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->type, $propertyValue);

                continue;
            }

            if ($this->isCollectionTransfer($propertyValue)) {
                $propertyTransfer = $this->createTransferCollectionTypePropertyTransfer($propertyName);
                $contentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->collectionType, $propertyValue[0]);

                continue;
            }

            $contentTransfer->properties[] = $this->createPrimitivePropertyTransfer($propertyName, $propertyValue);
        }

        yield $contentTransfer;

        return $helperContentTransfers;
    }

    private function createHelperContentTransfer(string $className, array $content): HelperContentTransfer
    {
        $contentTransfer = new HelperContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->content = $content;

        return $contentTransfer;
    }

    private function createTransferCollectionTypePropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->collectionType = $this->getClassName($propertyName);

        return $propertyTransfer;
    }

    private function isCollectionTransfer(mixed $propertyValue): bool
    {
        if (!is_array($propertyValue) || empty($propertyValue)) {
            return false;
        }

        return isset($propertyValue[0]) && is_array($propertyValue[0]) && key($propertyValue[0]) !== 0;
    }

    private function createTransferTypePropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->type = $this->getClassName($propertyName);

        return $propertyTransfer;
    }

    private function isTransfer(mixed $propertyValue): bool
    {
        if (!is_array($propertyValue) || empty($propertyValue)) {
            return false;
        }

        $key = key($propertyValue);

        return is_string($key);
    }

    private function createPrimitivePropertyTransfer(string $propertyName, mixed $propertyValue): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        if (is_string($propertyValue) || is_null($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::STRING->value;

            return $propertyTransfer;
        }

        if (is_int($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::INT->value;

            return $propertyTransfer;
        }

        if (is_float($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::FLOAT->value;

            return $propertyTransfer;
        }

        if (is_bool($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::BOOL->value;

            return $propertyTransfer;
        }

        if (is_array($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::ARRAY->value;

            return $propertyTransfer;
        }

        if ($propertyValue instanceof ArrayObject) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::ARRAY_OBJECT->value;

            return $propertyTransfer;
        }

        if (is_iterable($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeValueEnum::ITERABLE->value;

            return $propertyTransfer;
        }

        throw new HelperTransferException(
            sprintf(
                'Property "%s" type "%s" is not supported.',
                $propertyName,
                gettype($propertyValue),
            ),
        );
    }

    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    private function assertProperty(int|string $propertyName): void
    {
        if (is_int($propertyName)) {
            throw new HelperTransferException(
                'Cannot generate definition based on Root Level integer indexes.'
            );
        }
    }
}
