<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;

readonly class TemplateHelper implements TemplateHelperInterface
{
    private const array KEY_VALUE_SEARCH = [
        ':key',
        ':value',
    ];

    private const string PADDING_LEFT = '    ';
    private const string EMPTY_STRING = '';
    private const string NULLABLE_TYPE = '?';
    private const string NULLABLE_UNION = 'null|';
    private const string REQUIRED_METHOD_NAME = 'Required';

    public function __construct(private TemplateTransfer $templateTransfer)
    {
    }

    public static function getDefaultTemplateTransfer(): TemplateTransfer
    {
        return new TemplateTransfer()->fromArray([
            TemplateTransfer::CLASS_NAMESPACE => '\Default',
            TemplateTransfer::CLASS_NAME => 'DefaultTransfer',
            TemplateTransfer::IMPORTS => [
                TransferEnum::ABSTRACT_CLASS->value,
                TransferEnum::TRAIT->value,
            ],
        ]);
    }

    public function renderKeyValue(iterable $data, string $template): string
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
        $attribute = $this->templateTransfer->attributes[$property] ?? null;
        if ($attribute === null) {
            return self::EMPTY_STRING;
        }

        return PHP_EOL . self::PADDING_LEFT . $attribute;
    }

    public function getDockBlock(string $property): string
    {
        $dockBlock = $this->templateTransfer->dockBlocks[$property] ?? null;
        if ($dockBlock === null) {
            return self::EMPTY_STRING;
        }

        return PHP_EOL . self::PADDING_LEFT . $dockBlock;
    }

    public function getNullable(string $property): string
    {
        $propertyType = $this->templateTransfer->properties[$property];
        if (!$this->templateTransfer->nullables[$property] || str_contains($propertyType, '&')) {
            return self::EMPTY_STRING;
        }

        if (str_contains($propertyType, '|')) {
            return self::NULLABLE_UNION;
        }

        return self::NULLABLE_TYPE;
    }

    public function getRequired(string $property): string
    {
        return $this->templateTransfer->nullables[$property] ? self::EMPTY_STRING : self::REQUIRED_METHOD_NAME;
    }
}
