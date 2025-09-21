<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\CollectionTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\DateTimeTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\EnumTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\NullablePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\NumberTypePropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\PropertyExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\ProtectedPropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\TypePropertyExpander;

class ParserFactory
{
    use ConfigFactoryTrait;
    use SharedFactoryTrait;
    use CachedFactoryTrait;

    public function createDefinitionParser(): DefinitionParserInterface
    {
        return $this->getCached(
            key: 'definition-parser',
            factory: fn (): DefinitionParserInterface => new DefinitionParser(
                $this->createYmlParser(),
                $this->createContentBuilder(),
            ),
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
            ->setNextExpander($this->createTypePropertyExpander())
            ->setNextExpander($this->createEnumTypePropertyExpander())
            ->setNextExpander($this->createProtectedPropertyExpander())
            ->setNextExpander($this->createDateTimeTypePropertyExpander())
            ->setNextExpander($this->createNumberTypePropertyExpander());

        return $propertyExpander;
    }

    protected function createNumberTypePropertyExpander(): PropertyExpanderInterface
    {
        return new NumberTypePropertyExpander($this->createEmbeddedTypeBuilder());
    }

    protected function createEmbeddedTypeBuilder(): EmbeddedTypeBuilderInterface
    {
        return new EmbeddedTypeBuilder($this->createNamespaceBuilder());
    }

    protected function createNamespaceBuilder(): NamespaceBuilderInterface
    {
        return new NamespaceBuilder();
    }

    protected function createDateTimeTypePropertyExpander(): PropertyExpanderInterface
    {
        return new DateTimeTypePropertyExpander($this->createEmbeddedTypeBuilder());
    }

    protected function createProtectedPropertyExpander(): PropertyExpanderInterface
    {
        return new ProtectedPropertyExpander();
    }

    protected function createEnumTypePropertyExpander(): PropertyExpanderInterface
    {
        return new EnumTypePropertyExpander($this->createEmbeddedTypeBuilder());
    }

    protected function createTypePropertyExpander(): PropertyExpanderInterface
    {
        return new TypePropertyExpander($this->createEmbeddedTypeBuilder());
    }

    protected function createCollectionTypePropertyExpander(): PropertyExpanderInterface
    {
        return new CollectionTypePropertyExpander($this->createEmbeddedTypeBuilder());
    }

    protected function createNullablePropertyExpander(): PropertyExpanderInterface
    {
        return new NullablePropertyExpander();
    }
}
