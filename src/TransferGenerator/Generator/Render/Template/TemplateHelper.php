<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

class TemplateHelper implements TemplateHelperInterface
{
    private TemplateTransfer $templateTransfer;

    private const string IMPORT_TEMPLATE = 'use %s;' . PHP_EOL;
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

    private const string PADDING_LEFT = '    ';
    private const string PHP_EOL_PADDING_LEFT = PHP_EOL . self::PADDING_LEFT;

    private const string EMPTY_STRING = '';
    private const string NULLABLE_TYPE = '?';
    private const string NULLABLE_UNION = 'null|';
    private const string PROTECTED_SET = ' protected(set)';

    private const string PROPERTY_ATTRIBUTE_TEMPLATE = '    #[%s]' . PHP_EOL;

    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self
    {
        $this->templateTransfer = $templateTransfer;

        return $this;
    }

    public function renderImports(): string
    {
        $imports = '';
        foreach ($this->templateTransfer->imports as $import) {
            $imports .= sprintf(self::IMPORT_TEMPLATE, $import);
        }

        return rtrim($imports, PHP_EOL);
    }

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

    public function renderMetaAttributes(string $property): string
    {
        $metaAttributes = $this->templateTransfer->metaAttributes[$property] ?? null;
        if ($metaAttributes === null) {
            return self::EMPTY_STRING;
        }

        $renderedMetaAttributes = '';
        foreach ($metaAttributes as $attribute) {
            $renderedMetaAttributes .= self::PADDING_LEFT . $attribute . PHP_EOL;
        }

        return PHP_EOL . rtrim($renderedMetaAttributes, PHP_EOL);
    }

    public function renderDocBlock(string $property): string
    {
        $docBlock = $this->templateTransfer->docBlocks[$property] ?? null;
        if ($docBlock === null) {
            return self::EMPTY_STRING;
        }

        return self::PHP_EOL_PADDING_LEFT . $docBlock;
    }

    public function renderPropertyAttributes(string $property): string
    {
        $propertyAttributes = $this->templateTransfer->propertyAttributes[$property] ?? null;
        if ($propertyAttributes === null) {
            return '';
        }

        $attributes = '';
        foreach ($propertyAttributes as $attribute) {
            $attributes .= sprintf(self::PROPERTY_ATTRIBUTE_TEMPLATE, $attribute);
        }

        return PHP_EOL . rtrim($attributes, PHP_EOL);
    }

    public function renderPropertyDeclaration(string $property): string
    {
        /** @var string $propertyType */
        $propertyType = $this->templateTransfer->properties[$property];

        return "{$this->renderProtected($property)} {$this->renderNullable($property)}$propertyType";
    }

    public function renderNullable(string $property): string
    {
        /** @var string $propertyType */
        $propertyType = $this->templateTransfer->properties[$property];
        $isNullable = $this->templateTransfer->nullables[$property];

        if (!$isNullable || str_contains($propertyType, '&')) {
            return self::EMPTY_STRING;
        }

        if (str_contains($propertyType, '|')) {
            return self::NULLABLE_UNION;
        }

        return self::NULLABLE_TYPE;
    }

    private function renderProtected(string $property): string
    {
        return $this->templateTransfer->protects[$property] ? self::PROTECTED_SET : self::EMPTY_STRING;
    }
}
