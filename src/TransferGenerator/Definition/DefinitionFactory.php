<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition;

use ArrayObject;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainerTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinder;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\BuildInTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\CollectionTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\EnumTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\PropertyExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander\TransferTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ClassNameValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\BuildInTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\CollectionTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\EnumTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\NamePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\PropertyValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\RequiredTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\ReservedPropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\TransferTypePropertyValidator;

readonly class DefinitionFactory
{
    use ConfigContainerTrait;
    use DependencyFactoryTrait;

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionReader(
            $this->createDefinitionFinder(),
            $this->createYmlParser(),
            $this->createDefinitionBuilder(),
        );
    }

    protected function createDefinitionBuilder(): DefinitionBuilderInterface
    {
        return new DefinitionBuilder(
            $this->createContentValidator(),
            $this->createPropertyExpanders(),
        );
    }

    /**
     * @return \ArrayObject<int,PropertyExpanderInterface> $propertyExpanders
     */
    protected function createPropertyExpanders(): ArrayObject
    {
        return new ArrayObject([
            $this->createCollectionTypePropertyExpander(),
            $this->createBuildInTypePropertyExpander(),
            $this->createTransferTypePropertyExpander(),
            $this->createEnumTypePropertyExpander(),
        ]);
    }

    protected function createEnumTypePropertyExpander(): PropertyExpanderInterface
    {
        return new EnumTypePropertyExpander();
    }

    protected function createTransferTypePropertyExpander(): PropertyExpanderInterface
    {
        return new TransferTypePropertyExpander();
    }

    protected function createBuildInTypePropertyExpander(): PropertyExpanderInterface
    {
        return new BuildInTypePropertyExpander();
    }

    protected function createCollectionTypePropertyExpander(): PropertyExpanderInterface
    {
        return new CollectionTypePropertyExpander();
    }

    protected function createContentValidator(): ContentValidatorInterface
    {
        return new ContentValidator(
            $this->createClassNameValidator(),
            $this->createPropertyValidators(),
        );
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\PropertyValidatorInterface>
     */
    protected function createPropertyValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createNamePropertyValidator(),
            $this->createReservedPropertyValidator(),
            $this->createRequiredTypePropertyValidator(),
            $this->createBuildInTypePropertyValidator(),
            $this->createTransferTypePropertyValidator(),
            $this->createCollectionTypePropertyValidator(),
            $this->createEnumTypePropertyValidator(),
        ]);
    }

    protected function createEnumTypePropertyValidator(): PropertyValidatorInterface
    {
        return new EnumTypePropertyValidator();
    }

    protected function createCollectionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new CollectionTypePropertyValidator($this->createClassNameValidator());
    }

    protected function createTransferTypePropertyValidator(): PropertyValidatorInterface
    {
        return new TransferTypePropertyValidator($this->createClassNameValidator());
    }

    protected function createBuildInTypePropertyValidator(): PropertyValidatorInterface
    {
        return new BuildInTypePropertyValidator();
    }

    protected function createRequiredTypePropertyValidator(): PropertyValidatorInterface
    {
        return new RequiredTypePropertyValidator();
    }

    protected function createReservedPropertyValidator(): PropertyValidatorInterface
    {
        return new ReservedPropertyValidator();
    }

    protected function createNamePropertyValidator(): PropertyValidatorInterface
    {
        return new NamePropertyValidator();
    }

    protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return new ClassNameValidator();
    }

    protected function createYmlParser(): YmlParserInterface
    {
        return $this->getDependency(DependencyContainer::YML_PARSER);
    }

    protected function createDefinitionFinder(): DefinitionFinderInterface
    {
        return new DefinitionFinder(
            $this->createFinder(),
            $this->getConfig(),
        );
    }

    protected function createFinder(): FinderInterface
    {
        return $this->getDependency(DependencyContainer::FINDER);
    }
}
