<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Reader;

use ArrayObject;
use Generator;
use Picamator\TransferObject\Definition\Enum\DefinitionKeyEnum;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Definition\Parser\ContentParserInterface;
use Picamator\TransferObject\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFilesystemInterface $filesystem,
        private ContentParserInterface $parser,
        private ContentValidatorInterface $validator,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $definitionCount = 0;
        $definitionContents = $this->filesystem->getDefinitionContent();
        foreach ($definitionContents as $fileName => $definitionContent) {
            $definition = $this->parser->parseContent($definitionContent);

            foreach ($definition as $className => $properties) {
                $contentTransfer = $this->createContentTransfer($className, $properties);
                $definitionTransfer = $this->createDefinitionTransfer($contentTransfer);

                $definitionCount++;

                yield $fileName . ':' . $className => $definitionTransfer;
            }
        }

        return $definitionCount;
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
     * @param array<string, array<string, string>> $properties
     */
    private function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->properties = new ArrayObject();

        foreach ($properties as $propertyName => $propertyType) {
            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = $propertyType[DefinitionKeyEnum::TYPE->value] ?? null;
            $propertyTransfer->collectionType = $propertyType[DefinitionKeyEnum::COLLECTION_TYPE->value] ?? null;

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }
}
