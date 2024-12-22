<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\AbstractTransfer;

enum TransferEnum: string
{
    case ABSTRACT_CLASS = AbstractTransfer::class;
}
