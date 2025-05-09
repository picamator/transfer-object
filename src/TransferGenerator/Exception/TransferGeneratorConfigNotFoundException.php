<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Exception;

use LogicException;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class TransferGeneratorConfigNotFoundException extends LogicException implements TransferExceptionInterface
{
}
