<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Exception;

use Exception;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class DefinitionGeneratorException extends Exception implements TransferExceptionInterface
{
}
