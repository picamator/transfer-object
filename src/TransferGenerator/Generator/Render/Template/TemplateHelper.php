<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

class TemplateHelper implements TemplateHelperInterface
{
    private TemplateTransfer $templateTransfer;

    private const string IMPORT_TEMPLATE = 'use %s;';
    private const string META_DATA_TEMPLATE = '        self::%1$s_INDEX => self::%1$s,';

    private const string PADDING_LEFT = PHP_EOL . '    ';
    private const string EMPTY_STRING = '';
    private const string NULLABLE_TYPE = '?';
    private const string NULLABLE_UNION = 'null|';
    private const string PROTECTED_SET = ' protected(set)';

    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self
    {
        $this->templateTransfer = $templateTransfer;

        return $this;
    }

    public function renderImports(): string
    {
        $imports = [];
        /** @var string $import */
        foreach ($this->templateTransfer->imports as $import) {
            $imports[] = sprintf(self::IMPORT_TEMPLATE, $import);
        }

        return implode(PHP_EOL, $imports);
    }

    public function renderMetaData(): string
    {
        $metaData = [];
        foreach (array_keys($this->templateTransfer->metaConstants->getArrayCopy()) as $value) {
            $metaData[] = sprintf(self::META_DATA_TEMPLATE, $value);
        }

        return implode(PHP_EOL, $metaData);
    }

    public function renderAttribute(string $property): string
    {
        /** @var string|null $attribute */
        $attribute = $this->templateTransfer->attributes[$property] ?? null;
        if ($attribute === null) {
            return self::EMPTY_STRING;
        }

        return self::PADDING_LEFT . $attribute;
    }

    public function renderDockBlock(string $property): string
    {
        /** @var string|null $dockBlock */
        $dockBlock = $this->templateTransfer->dockBlocks[$property] ?? null;
        if ($dockBlock === null) {
            return self::EMPTY_STRING;
        }

        return self::PADDING_LEFT . $dockBlock;
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
        if (!$this->templateTransfer->nullables[$property] || str_contains($propertyType, '&')) {
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
