<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Throwable;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFinderInterface $finder,
        private DefinitionParserInterface $parser,
        private DefinitionValidatorInterface $validator,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $count = 0;
        foreach ($this->finder->getDefinitionContent() as $fileName => $definitionContent) {
            try {
                $contentGenerator = $this->handleContentGenerator($fileName, $definitionContent);
                yield from $contentGenerator;

                $count += $contentGenerator->getReturn();
            } catch (Throwable $e) {
                $count++;
                yield $this->createErrorDefinitionTransfer($fileName, $e);
            }
        }

        return $count;
    }

    public function getDefinitionFileCount(): int
    {
        return $this->finder->getDefinitionCount();
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return \Generator<int, \Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    private function handleContentGenerator(string $fileName, string $definitionContent): Generator
    {
        $contentGenerator = $this->parser->parseDefinition($definitionContent);
        foreach ($contentGenerator as $contentTransfer) {
            $definitionTransfer = new DefinitionTransfer();
            $definitionTransfer->fileName = $fileName;
            $definitionTransfer->content = $contentTransfer;
            $definitionTransfer->validator = $this->validator->validate($contentTransfer);

            yield $definitionTransfer;
        }

        return $contentGenerator->getReturn();
    }

    private function createErrorDefinitionTransfer(string $fileName, Throwable $e): DefinitionTransfer
    {
        $definitionTransfer = new DefinitionTransfer();
        $definitionTransfer->fileName = $fileName;

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
