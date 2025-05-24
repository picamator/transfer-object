<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\ParserFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorFactory;

class DefinitionFactory
{
    use CachedFactoryTrait;

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'definition-reader',
            factory: fn (): DefinitionReaderInterface =>
                new DefinitionReader(
                    $this->createDefinitionFinder(),
                    $this->createDefinitionParser(),
                    $this->createDefinitionValidator(),
                ),
        );
    }

    protected function createDefinitionValidator(): DefinitionValidatorInterface
    {
        return new ValidatorFactory()->createDefinitionValidator();
    }

    protected function createDefinitionFinder(): DefinitionFinderInterface
    {
        return new ParserFactory()->createDefinitionFinder();
    }

    protected function createDefinitionParser(): DefinitionParserInterface
    {
        return new ParserFactory()->createDefinitionParser();
    }
}
