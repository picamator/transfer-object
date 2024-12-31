<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;
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
        try {
            $count = 0;
            $definitionFiles = $this->finder->getDefinitionFiles();
            foreach ($definitionFiles as $fileName => $filePath) {
                $contentGenerator = $this->getContentGenerator($fileName, $filePath);
                yield from $contentGenerator;

                $count += $contentGenerator->getReturn();
            }
        } catch (FinderException | TransferGeneratorDefinitionException $e) {
            yield $this->createErrorDefinitionTransfer($e);
        }

        return $count;
    }

    /**
     * @return \Generator<int, \Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    private function getContentGenerator(string $fileName, string $filePath): Generator
    {
        try {
            $contentGenerator = $this->parser->parseDefinition($filePath);
            foreach ($contentGenerator as $contentTransfer) {
                $definitionTransfer = new DefinitionTransfer();
                $definitionTransfer->fileName = $fileName;
                $definitionTransfer->content = $contentTransfer;
                $definitionTransfer->validator = $this->validator->validate($contentTransfer);

                yield $definitionTransfer;
            }
        } catch (YmlParserException $e) {
            yield $this->createErrorDefinitionTransfer($e, $fileName);

            return 0;
        }

        return $contentGenerator->getReturn();
    }

    private function createErrorDefinitionTransfer(Throwable $e, ?string $fileName = null): DefinitionTransfer
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
