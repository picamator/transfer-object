<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Enum;

use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;

enum DefinitionTypeKeyEnum: string
{
    case BUILD_IN_TYPE =  DefinitionPropertyTransfer::BUILD_IN_TYPE;
    case TRANSFER_TYPE = DefinitionPropertyTransfer::TRANSFER_TYPE;
    case COLLECTION_TYPE = DefinitionPropertyTransfer::COLLECTION_TYPE;
}
