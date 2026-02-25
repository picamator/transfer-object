<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum FilesystemEnum: string
{
    case CACHE_FILE_NAME = 'transfer-object.list.csv';
    case TRANSFER_FILE_EXTENSION = '.php';
    case TRANSFER_FILE_NAME_PATTERN = '*Transfer.php';
}
