<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\TemplateTransfer;

trait TemplateRenderTrait
{
    protected const string FILE_NAME_SUFFIX = 'Transfer';

    protected const array SORTABLE_PROPERTIES = [
        'imports',
        'metaConstants',
    ];

    protected function isCollectionType(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

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
