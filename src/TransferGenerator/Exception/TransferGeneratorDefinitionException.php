<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Exception;

use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use RuntimeException;

class TransferGeneratorDefinitionException extends RuntimeException implements TransferExceptionInterface
{
}
