<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

enum DefinitionTypeKeyEnum: string
{
    case BUILD_IN_TYPE = DefinitionPropertyTransfer::BUILD_IN_TYPE;
    case TRANSFER_TYPE = DefinitionPropertyTransfer::TRANSFER_TYPE;
    case COLLECTION_TYPE = DefinitionPropertyTransfer::COLLECTION_TYPE;
    case ENUM_TYPE = DefinitionPropertyTransfer::ENUM_TYPE;
    case DATE_TIME_TYPE = DefinitionPropertyTransfer::DATE_TIME_TYPE;
    case NUMBER_TYPE = DefinitionPropertyTransfer::NUMBER_TYPE;
}
