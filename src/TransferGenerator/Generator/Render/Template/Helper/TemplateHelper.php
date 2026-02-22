<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

use Picamator\TransferObject\Generated\TemplateTransfer;

class TemplateHelper implements TemplateHelperInterface
{
    use MetaHelperTrait;
    use IterableHelperTrait;
    use PropertyHelperTrait;

    private TemplateTransfer $templateTransfer;

    private const string IMPORT_TEMPLATE = 'use %s;' . PHP_EOL;
    private const string META_ATTRIBUTE_TEMPLATE = '    %s' . PHP_EOL;
    private const string DOC_BLOCK_TEMPLATE = PHP_EOL . '    %s';
    private const string PROPERTY_ATTRIBUTE_TEMPLATE = '    #[%s]' . PHP_EOL;

    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self
    {
        $this->templateTransfer = $templateTransfer;

        return $this;
    }

    public function renderImports(): string
    {
        return $this->renderIterable(
            iterable: $this->templateTransfer->imports,
            template: self::IMPORT_TEMPLATE,
        );
    }

    public function renderMetaAttributes(string $property): string
    {
        $metaAttributes = $this->templateTransfer->metaAttributes[$property] ?? null;
        if ($metaAttributes === null) {
            return '';
        }

        $renderedMetaAttributes = $this->renderIterable(
            iterable: $metaAttributes,
            template: self::META_ATTRIBUTE_TEMPLATE,
        );

        return PHP_EOL . $renderedMetaAttributes;
    }

    public function renderDocBlock(string $property): string
    {
        $docBlocks = $this->templateTransfer->docBlocks[$property] ?? null;
        if ($docBlocks === null) {
            return '';
        }

        return sprintf(self::DOC_BLOCK_TEMPLATE, $docBlocks);
    }

    public function renderPropertyAttributes(string $property): string
    {
        $attributes = $this->templateTransfer->propertyAttributes[$property] ?? null;
        if ($attributes === null) {
            return '';
        }

        $renderedAttributes = $this->renderIterable(
            iterable: $attributes,
            template: self::PROPERTY_ATTRIBUTE_TEMPLATE,
        );

        return PHP_EOL . $renderedAttributes;
    }
}
