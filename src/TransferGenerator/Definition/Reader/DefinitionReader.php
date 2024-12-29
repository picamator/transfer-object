<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ContentValidatorInterface;
use Throwable;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFinderInterface $finder,
        private DefinitionParserInterface $parser,
        private ContentValidatorInterface $validator,
    ) {
    }

    public function getDefinitions(): Generator
    {
        try {
            $definitionGenerator = $this->handleDefinitions();
            yield from $definitionGenerator;

            return $definitionGenerator->getReturn();
        } catch (Throwable $e) {
            yield $this->createErrorDefinitionTransfer($e);
        }

        return 0;
    }

    public function getDefinitionFileCount(): int
    {
        return $this->finder->getDefinitionCount();
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return \Generator<int, \Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    private function handleDefinitions(): Generator
    {
        $count = 0;
        foreach ($this->finder->getDefinitionContent() as $fileName => $definitionContent) {
            $contentGenerator = $this->parser->parseDefinition($definitionContent);
            foreach ($contentGenerator as $contentTransfer) {
                $definitionTransfer = new DefinitionTransfer();
                $definitionTransfer->fileName = $fileName;
                $definitionTransfer->content = $contentTransfer;
                $definitionTransfer->validator = $this->validator->validate($contentTransfer);

                yield $definitionTransfer;
            }

            $count += $contentGenerator->getReturn();
        }

        return $count;
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
