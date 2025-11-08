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

    private static ValidatorFactory $validatorFactory;

    private static ParserFactory $parserFactory;

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
        return $this->getValidatorFactory()->createDefinitionValidator();
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
        return $this->getParserFactory()->createDefinitionParser();
    }

    protected function getValidatorFactory(): ValidatorFactory
    {
        return self::$validatorFactory ??= new ValidatorFactory();
    }

    protected function getParserFactory(): ParserFactory
    {
        return self::$parserFactory ??= new ParserFactory();
    }
}
