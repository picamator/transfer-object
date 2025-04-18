<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferInterface;
use Picamator\TransferObject\Transfer\TransferTrait;

enum TransferEnum: string
{
    case INTERFACE = TransferInterface::class;
    case ABSTRACT_CLASS = AbstractTransfer::class;
    case TRAIT = TransferTrait::class;
}
