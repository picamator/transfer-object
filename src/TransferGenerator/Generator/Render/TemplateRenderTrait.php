<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\TemplateTransfer;

trait TemplateRenderTrait
{
    protected const string FILE_NAME_SUFFIX = 'Transfer';

    protected const array SORTABLE_PROPERTIES = [
        'imports',
        'metaConstants',
    ];

    protected function sortTemplate(TemplateTransfer $templateTransfer): void
    {
        foreach (static::SORTABLE_PROPERTIES as $property) {
            /** @var \ArrayObject<int|string,string> $value */
            $value = $templateTransfer->{$property};
            $value->natsort();
        }
    }

    protected function getMetaConstant(string $propertyName): string
    {
        return strtoupper(preg_replace('/([A-Z])/', '_$0', $propertyName));
    }

    protected function getTransferName(string $propertyType): string
    {
        return $propertyType . static::FILE_NAME_SUFFIX;
    }
}
