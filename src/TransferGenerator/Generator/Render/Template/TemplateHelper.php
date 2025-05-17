<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use ArrayObject;
use Picamator\TransferObject\Generated\TemplateTransfer;

class TemplateHelper implements TemplateHelperInterface
{
    private TemplateTransfer $templateTransfer;

    private const array KEY_VALUE_SEARCH = [
        ':key',
        ':value',
    ];

    private const string PADDING_LEFT = '    ';
    private const string EMPTY_STRING = '';
    private const string NULLABLE_TYPE = '?';
    private const string NULLABLE_UNION = 'null|';
    private const string PROTECTED_SET = ' protected(set)';

    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self
    {
        $this->templateTransfer = $templateTransfer;

        return $this;
    }

    public function renderKeyValue(ArrayObject $data, string $template): string
    {
        $iterateResult = [];
        foreach ($data as $key => $value) {
            $iterateResult[] = str_replace(
                self::KEY_VALUE_SEARCH,
                [$key, $value],
                $template,
            );
        }

        return implode(PHP_EOL, $iterateResult);
    }

    public function getAttribute(string $property): string
    {
        /** @var string|null $attribute */
        $attribute = $this->templateTransfer->attributes[$property] ?? null;
        if ($attribute === null) {
            return self::EMPTY_STRING;
        }

        return PHP_EOL . self::PADDING_LEFT . $attribute;
    }

    public function getDockBlock(string $property): string
    {
        /** @var string|null $dockBlock */
        $dockBlock = $this->templateTransfer->dockBlocks[$property] ?? null;
        if ($dockBlock === null) {
            return self::EMPTY_STRING;
        }

        return PHP_EOL . self::PADDING_LEFT . $dockBlock;
    }

    public function getNullable(string $property): string
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

    public function getProtected(string $property): string
    {
        return $this->templateTransfer->protects[$property] ? self::PROTECTED_SET : self::EMPTY_STRING;
    }
}
