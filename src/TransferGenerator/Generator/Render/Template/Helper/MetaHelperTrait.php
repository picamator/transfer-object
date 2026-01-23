<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

use ArrayObject;

/**
 * @property \Picamator\TransferObject\Generated\TemplateTransfer $templateTransfer
 */
trait MetaHelperTrait
{
    use IterableHelperTrait;

    private const string META_DATA_TEMPLATE = '        self::%1$s_PROP => self::%1$s_INDEX,' . PHP_EOL;

    private const string META_INITIATORS = 'META_INITIATORS';
    private const string META_TRANSFORMERS = 'META_TRANSFORMERS';

    private const string META_TEMPLATE = <<<'TEMPLATE'


    protected const array %s = [
%s
    ];
TEMPLATE;

    private const string META_ITEM_TEMPLATE = '        self::%1$s_PROP => \'%1$s_PROP\',' . PHP_EOL;

    public function renderMetaData(): string
    {
        return $this->renderIterable(
            iterable: $this->templateTransfer->metaConstants,
            template: self::META_DATA_TEMPLATE,
        );
    }

    public function renderMetaInitiators(): string
    {
        return $this->renderMeta(
            meta: $this->templateTransfer->metaInitiators,
            metaConstants: $this->templateTransfer->metaConstants,
            constantName: self::META_INITIATORS,
        );
    }

    public function renderMetaTransformers(): string
    {
        return $this->renderMeta(
            meta: $this->templateTransfer->metaTransformers,
            metaConstants: $this->templateTransfer->metaConstants,
            constantName: self::META_TRANSFORMERS,
        );
    }

    /**
     * @param \ArrayObject<int, string> $meta
     * @param \ArrayObject<string, string> $metaConstants
     */
    private function renderMeta(ArrayObject $meta, ArrayObject $metaConstants, string $constantName): string
    {
        if ($meta->count() === 0) {
            return '';
        }

        $renderedMeta = '';
        foreach ($meta as $propertyName) {
            $renderedMeta .= sprintf(self::META_ITEM_TEMPLATE, $metaConstants[$propertyName]);
        }

        $renderedMeta = rtrim($renderedMeta, PHP_EOL);

        return sprintf(self::META_TEMPLATE, $constantName, $renderedMeta);
    }
}
