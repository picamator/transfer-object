<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Throwable;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFinderInterface $finder,
        private YmlParserInterface $parser,
        private DefinitionBuilderInterface $definitionBuilder,
    ) {
    }

    public function getDefinitions(): Generator
    {
        try {
            $count = 0;
            foreach ($this->handleGetDefinitions() as $key => $definition) {
                $count++;
                yield $key => $definition;
            }
        } catch (Throwable $e) {
            $count++;
            yield '----:----' => $this->createErrorDefinitionTransfer($e);
        }

        return $count;
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    private function handleGetDefinitions(): Generator
    {
        foreach ($this->finder->getDefinitionContent() as $fileName => $definitionContent) {
            $definition = $this->parser->parse($definitionContent);
            foreach ($definition as $className => $properties) {
                yield $fileName . ':' . $className
                    => $this->definitionBuilder->buildDefinitionTransfer((string)$className, $properties);
            }
        }
    }

    private function createErrorDefinitionTransfer(Throwable $e): DefinitionTransfer
    {
        $definitionTransfer = new DefinitionTransfer();

        $definitionTransfer->validator = new DefinitionValidatorTransfer();
        $definitionTransfer->validator->isValid = false;
        $definitionTransfer->validator->errorMessages[] = new ValidatorMessageTransfer()
            ->fromArray([
                ValidatorMessageTransfer::IS_VALID => false,
                ValidatorMessageTransfer::ERROR_MESSAGE => $e->getMessage(),
            ]);

        return $definitionTransfer;
    }
}
