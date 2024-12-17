<?php declare(strict_types=1);

namespace Picamator\TransferObject\Helper\Reader;

trait HelperReaderTrait
{
    protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, '_');

        return str_replace('_', '', $className);
    }
}
