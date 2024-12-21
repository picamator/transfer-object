<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Reader;

use Generator;
use Picamator\TransferObject\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\Definition\Parser\ContentParserInterface;
use Picamator\TransferObject\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionTransfer;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    private const string TYPE_KEY = 'type';
    private const string COLLECTION_TYPE_KEY = 'collectionType';

    public function __construct(
        private DefinitionFinderInterface $finder,
        private ContentParserInterface $parser,
        private ContentValidatorInterface $validator,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $definitionContents = $this->finder->getDefinitionContent();
        foreach ($definitionContents as $fileName => $definitionContent) {
            $definition = $this->parser->parseContent($definitionContent);

            foreach ($definition as $className => $properties) {
                $contentTransfer = $this->createContentTransfer((string)$className, $properties);
                $definitionTransfer = $this->createDefinitionTransfer($contentTransfer);

                yield $fileName . ':' . $className => $definitionTransfer;
            }
        }

        return $definitionContents->getReturn();
    }

    private function createDefinitionTransfer(DefinitionContentTransfer $contentTransfer): DefinitionTransfer
    {
        $validatorTransfer = $this->validator->validate($contentTransfer);

        $definitionTransfer = new DefinitionTransfer();
        $definitionTransfer->content = $contentTransfer;
        $definitionTransfer->validator = $validatorTransfer;

        return $definitionTransfer;
    }

    /**
     * @param array<string|int, array<string, string>> $properties
     */
    private function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;

        foreach ($properties as $propertyName => $propertyType) {
            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = (string)$propertyName;
            $propertyTransfer->collectionType = $this->getCollectionType($propertyType);
            $this->expandTypeKey($propertyType, $propertyTransfer);

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }

    /**
     * @param array<string,mixed> $propertyType
     */
    private function getCollectionType(array $propertyType): ?string
    {
        $collectionType = $propertyType[self::COLLECTION_TYPE_KEY] ?? null;
        if ($collectionType === null) {
            return null;
        }

        return (string)$collectionType;
    }

    /**
     * @param array<string,mixed> $propertyType
     */
    private function expandTypeKey(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return;
        }

        if (is_bool($type)) {
            $type = BuildInTypeEnum::getTrueFalse($type)->value;
        }

        if (BuildInTypeEnum::isBuildInType($type)) {
            $propertyTransfer->buildInType = $type;

            return;
        }

        $propertyTransfer->transferType = $type;
    }
}
