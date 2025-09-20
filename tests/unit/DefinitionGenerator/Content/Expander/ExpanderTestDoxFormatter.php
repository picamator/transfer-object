<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;

class ExpanderTestDoxFormatter
{
    /**
     * @param array<string,mixed> $propertyValue
     */
    public static function applicableTransferTypeFormatter(
        GetTypeEnum $type,
        array $propertyValue,
        bool $expected,
    ): string {
        return sprintf(
            'Property type "%s" expander with value "%s" is applicable "%s"',
            $type->value,
            json_encode($propertyValue),
            $expected ? 'true' : 'false',
        );
    }
}
