<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class TemplateHelper implements TemplateHelperInterface
{
    private const string PADDING_LEFT = '    ';

    private const array KEY_VALUE_SEARCH = [
        ':key',
        ':value',
    ];

    public function __construct(private TemplateTransfer $templateTransfer)
    {
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
            return '';
        }

        return PHP_EOL . self::PADDING_LEFT . $attribute;
    }

    public function getDockBlock(string $property): string
    {
        $dockBlock = $this->templateTransfer->dockBlocks[$property] ?? null;
        if ($dockBlock === null) {
            return '';
        }

        return PHP_EOL . self::PADDING_LEFT . $dockBlock;
    }

    public function getNullable(string $property): string
    {
        return $this->templateTransfer->nullables[$property] ? '?' : '';
    }
}
