<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition;

use ArrayObject;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinder;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\ContentBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\ContentBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParser;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\BuildInTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\CollectionTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\DateTimeTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\EnumTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\NullablePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\NumberTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\PropertyExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\ProtectedPropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\TransferTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\ClassNameContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\ContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\EmptyPropertiesContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\PropertiesContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\BuildInTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\CollectionTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\DateTimeTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\EnumTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\NamePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\NumberTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\PropertyValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\RequiredTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\ReservedNamePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\TransferTypePropertyValidator;

readonly class DefinitionFactory
{
    use ConfigFactoryTrait;
    use SharedFactoryTrait;

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionReader(
            $this->createDefinitionFinder(),
            $this->createDefinitionParser(),
            $this->createContentValidator(),
        );
    }

    protected function createContentValidator(): DefinitionValidatorInterface
    {
        return new DefinitionValidator(
            $this->createContentValidators(),
        );
    }

    /**
     * @return \ArrayObject<int,ContentValidatorInterface>
     */
    protected function createContentValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createClassNameContentValidator(),
            $this->createEmptyPropertiesContentValidator(),
            $this->createPropertiesContentValidator(),
        ]);
    }

    protected function createPropertiesContentValidator(): ContentValidatorInterface
    {
        return new PropertiesContentValidator($this->createPropertyValidators());
    }

    /**
     * @return \ArrayObject<int,PropertyValidatorInterface>
     */
    protected function createPropertyValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createReservedNamePropertyValidator(),
            $this->createNamePropertyValidator(),
            $this->createRequiredTypePropertyValidator(),
            $this->createBuildInTypePropertyValidator(),
            $this->createTransferTypePropertyValidator(),
            $this->createCollectionTypePropertyValidator(),
            $this->createEnumTypePropertyValidator(),
            $this->createDateTimeTypePropertyValidator(),
            $this->createNumberTypePropertyValidator(),
        ]);
    }

    protected function createNumberTypePropertyValidator(): PropertyValidatorInterface
    {
        return new NumberTypePropertyValidator();
    }

    protected function createDateTimeTypePropertyValidator(): PropertyValidatorInterface
    {
        return new DateTimeTypePropertyValidator();
    }

    protected function createEnumTypePropertyValidator(): PropertyValidatorInterface
    {
        return new EnumTypePropertyValidator();
    }

    protected function createCollectionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new CollectionTypePropertyValidator(
            $this->createClassNameValidator(),
            $this->createNamespaceValidator(),
        );
    }

    protected function createTransferTypePropertyValidator(): PropertyValidatorInterface
    {
        return new TransferTypePropertyValidator(
            $this->createClassNameValidator(),
            $this->createNamespaceValidator(),
        );
    }

    protected function createBuildInTypePropertyValidator(): PropertyValidatorInterface
    {
        return new BuildInTypePropertyValidator();
    }

    protected function createRequiredTypePropertyValidator(): PropertyValidatorInterface
    {
        return new RequiredTypePropertyValidator();
    }

    protected function createNamePropertyValidator(): PropertyValidatorInterface
    {
        return new NamePropertyValidator();
    }

    protected function createReservedNamePropertyValidator(): PropertyValidatorInterface
    {
        return new ReservedNamePropertyValidator();
    }

    protected function createEmptyPropertiesContentValidator(): ContentValidatorInterface
    {
        return new EmptyPropertiesContentValidator();
    }

    protected function createClassNameContentValidator(): ContentValidatorInterface
    {
        return new ClassNameContentValidator($this->createClassNameValidator());
    }

    protected function createDefinitionParser(): DefinitionParserInterface
    {
        return new DefinitionParser(
            $this->getYmlParser(),
            $this->createContentBuilder(),
        );
    }

    protected function createContentBuilder(): ContentBuilderInterface
    {
        return new ContentBuilder($this->createPropertyExpander());
    }

    protected function createPropertyExpander(): PropertyExpanderInterface
    {
        $propertyExpander = $this->createNullablePropertyExpander();

        $propertyExpander
            ->setNextExpander($this->createCollectionTypePropertyExpander())
            ->setNextExpander($this->createBuildInTypePropertyExpander())
            ->setNextExpander($this->createTransferTypePropertyExpander())
            ->setNextExpander($this->createEnumTypePropertyExpander())
            ->setNextExpander($this->createProtectedPropertyExpander())
            ->setNextExpander($this->createDateTimeTypePropertyExpander())
            ->setNextExpander($this->createNumberTypePropertyExpander());

        return $propertyExpander;
    }

    protected function createNumberTypePropertyExpander(): PropertyExpanderInterface
    {
        return new NumberTypePropertyExpander();
    }

    protected function createDateTimeTypePropertyExpander(): PropertyExpanderInterface
    {
        return new DateTimeTypePropertyExpander();
    }

    protected function createProtectedPropertyExpander(): PropertyExpanderInterface
    {
        return new ProtectedPropertyExpander();
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

    protected function createNullablePropertyExpander(): PropertyExpanderInterface
    {
        return new NullablePropertyExpander();
    }

    protected function createDefinitionFinder(): DefinitionFinderInterface
    {
        return new DefinitionFinder(
            $this->getFinder(),
            $this->getConfig(),
        );
    }
}
