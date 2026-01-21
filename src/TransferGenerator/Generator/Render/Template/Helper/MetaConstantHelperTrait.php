<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

/**
 * @property \Picamator\TransferObject\Generated\TemplateTransfer $templateTransfer
 */
trait MetaConstantHelperTrait
{
    private const string META_DATA_TEMPLATE = '        self::%1$s_PROP => self::%1$s_INDEX,' . PHP_EOL;

    private const string META_INITIATORS_TEMPLATE = <<<'TEMPLATE'


    protected const array META_INITIATORS = [
%s
    ];
TEMPLATE;

    private const string META_TRANSFORMERS_TEMPLATE = <<<'TEMPLATE'


    protected const array META_TRANSFORMERS = [
%s
    ];
TEMPLATE;

    private const string META_ITEM_TEMPLATE = '        self::%1$s_PROP => \'%1$s_PROP\',' . PHP_EOL;

    public function renderMetaData(): string
    {
        $metaData = '';

        $iterator = $this->templateTransfer->metaConstants->getIterator();
        $iterator->rewind();

        while ($iterator->valid()) {
            $metaData .= sprintf(self::META_DATA_TEMPLATE, $iterator->key());
            $iterator->next();
        }

        return rtrim($metaData, PHP_EOL);
    }

    public function renderMetaInitiators(): string
    {
        if ($this->templateTransfer->metaInitiators->count() === 0) {
            return '';
        }

        $metaInitiators = '';
        $metaData = array_flip($this->templateTransfer->metaConstants->getArrayCopy());

        $iterator = $this->templateTransfer->metaInitiators->getIterator();
        $iterator->rewind();

        while ($iterator->valid()) {
            /** @var string $propertyName */
            $propertyName = $iterator->current();
            $metaInitiators .= sprintf(self::META_ITEM_TEMPLATE, $metaData[$propertyName]);
            $iterator->next();
        }

        if ($metaInitiators === '') {
            return '';
        }

        $metaInitiators = rtrim($metaInitiators, PHP_EOL);

        return sprintf(self::META_INITIATORS_TEMPLATE, $metaInitiators);
    }

    public function renderMetaTransformers(): string
    {
        if ($this->templateTransfer->metaTransformers->count() === 0) {
            return '';
        }

        $metaTransformers = '';
        $metaData = array_flip($this->templateTransfer->metaConstants->getArrayCopy());

        $iterator = $this->templateTransfer->metaTransformers->getIterator();
        $iterator->rewind();

        while ($iterator->valid()) {
            /** @var string $propertyName */
            $propertyName = $iterator->current();
            $metaTransformers .= sprintf(self::META_ITEM_TEMPLATE, $metaData[$propertyName]);
            $iterator->next();
        }

        if ($metaTransformers === '') {
            return '';
        }

        $metaTransformers = rtrim($metaTransformers, PHP_EOL);

        return sprintf(self::META_TRANSFORMERS_TEMPLATE, $metaTransformers);
    }
}
