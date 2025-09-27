<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    use ValidatorTrait;

    public function __construct(
        private DefinitionFinderInterface $finder,
        private DefinitionParserInterface $parser,
        private DefinitionValidatorInterface $validator,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $count = 0;

        try {
            $definitionFiles = $this->finder->getDefinitionFiles();
            foreach ($definitionFiles as $fileName => $filePath) {
                $contentGenerator = $this->getContentGenerator($fileName, $filePath);

                yield from $contentGenerator;

                /** @phpstan-ignore assignOp.invalid */
                $count += $contentGenerator->getReturn();
            }
        } catch (FinderException | TransferGeneratorDefinitionException | YmlParserException $e) {
            yield $this->createErrorDefinitionTransfer(errorMessage: $e->getMessage(), fileName: $fileName ?? '');
        }

        return $count;
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return \Generator<int, \Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    private function getContentGenerator(string $fileName, string $filePath): Generator
    {
        $contentGenerator = $this->parser->parseDefinition($filePath);
        foreach ($contentGenerator as $contentTransfer) {
            yield $this->createDefinitionTransfer($fileName, $contentTransfer);
        }

        return $contentGenerator->getReturn();
    }

    private function createDefinitionTransfer(
        string $fileName,
        DefinitionContentTransfer $contentTransfer,
    ): DefinitionTransfer {
        $definitionTransfer = new DefinitionTransfer();

        $definitionTransfer->fileName = $fileName;
        $definitionTransfer->content = $contentTransfer;
        $definitionTransfer->validator = $this->validator->validate($contentTransfer);

        return $definitionTransfer;
    }

    private function createErrorDefinitionTransfer(string $errorMessage, string $fileName): DefinitionTransfer
    {
        $definitionTransfer = new DefinitionTransfer();

        $definitionTransfer->fileName = $fileName;
        $definitionTransfer->content = new DefinitionContentTransfer();
        $definitionTransfer->content->className = '';
        $definitionTransfer->validator = $this->createErrorValidatorTransfer($errorMessage);

        return $definitionTransfer;
    }
}
