<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition;

use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinder;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\ParserFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorFactory;

class DefinitionFactory
{
    use ConfigFactoryTrait;
    use SharedFactoryTrait;

    public function __construct(
        private readonly ValidatorFactory $validatorFactory = new ValidatorFactory(),
        private readonly ParserFactory $parserFactory = new ParserFactory(),
    ) {
    }

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        return $this->getCached(
            key: 'transfer-generator:DefinitionReader',
            factory: fn(): DefinitionReaderInterface =>
                new DefinitionReader(
                    $this->createDefinitionFinder(),
                    $this->createDefinitionParser(),
                    $this->createDefinitionValidator(),
                ),
        );
    }

    protected function createDefinitionValidator(): DefinitionValidatorInterface
    {
        return $this->validatorFactory->createDefinitionValidator();
    }

    protected function createDefinitionFinder(): DefinitionFinderInterface
    {
        return new DefinitionFinder(
            $this->createFinder(),
            $this->getConfig(),
        );
    }

    protected function createDefinitionParser(): DefinitionParserInterface
    {
        return $this->parserFactory->createDefinitionParser();
    }
}
