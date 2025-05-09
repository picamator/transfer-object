<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Exception;

use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use RuntimeException;

class DefinitionGeneratorException extends RuntimeException implements TransferExceptionInterface
{
}
