<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Reader;

use Generator;
use Picamator\TransferObject\Definition\Enum\TypeKeyEnum;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\Definition\Parser\ContentParserInterface;
use Picamator\TransferObject\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionTransfer;

readonly class DefinitionReader implements DefinitionReaderInterface
{
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
                $contentTransfer = $this->createContentTransfer($className, $properties);
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
     * @param array<string, array<string, string>> $properties
     */
    private function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;

        foreach ($properties as $propertyName => $propertyType) {
            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = $propertyType[TypeKeyEnum::TYPE->value] ?? null;
            $propertyTransfer->collectionType = $propertyType[TypeKeyEnum::COLLECTION_TYPE->value] ?? null;

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }
}
