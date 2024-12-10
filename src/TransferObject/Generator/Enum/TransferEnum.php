<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum TransferEnum: string
{
    case ABSTRACT_CLASS_NAME = 'Picamator\TransferObject\Transfer\AbstractTransfer';
    case FILE_NAME_SUFFIX = 'Transfer';
    case FILE_NAME_PATTERN = '*Transfer.php';
    case FILE_EXTENSIONS = '.php';
}
