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
        if (!$this->templateTransfer->metaAttributes->offsetExists($property)) {
            return '';
        }

        $metaAttributes = $this->renderIterable(
            /** @phpstan-ignore argument.type */
            iterable: $this->templateTransfer->metaAttributes[$property],
            template: self::META_ATTRIBUTE_TEMPLATE,
        );

        return PHP_EOL . $metaAttributes;
    }

    public function renderDocBlock(string $property): string
    {
        if (!$this->templateTransfer->docBlocks->offsetExists($property)) {
            return '';
        }

        return sprintf(
            self::DOC_BLOCK_TEMPLATE,
            $this->templateTransfer->docBlocks[$property],
        );
    }

    public function renderPropertyAttributes(string $property): string
    {
        if (!$this->templateTransfer->propertyAttributes->offsetExists($property)) {
            return '';
        }

        $attributes = $this->renderIterable(
            /** @phpstan-ignore argument.type */
            iterable: $this->templateTransfer->propertyAttributes[$property],
            template: self::PROPERTY_ATTRIBUTE_TEMPLATE,
        );

        return PHP_EOL . $attributes;
    }
}
