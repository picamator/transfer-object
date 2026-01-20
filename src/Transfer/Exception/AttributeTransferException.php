<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Exception;

use InvalidArgumentException;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class AttributeTransferException extends InvalidArgumentException implements TransferExceptionInterface
{
}
