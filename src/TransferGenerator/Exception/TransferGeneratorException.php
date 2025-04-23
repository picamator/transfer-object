<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Exception;

use Exception;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class TransferGeneratorException extends Exception implements TransferExceptionInterface
{
}
