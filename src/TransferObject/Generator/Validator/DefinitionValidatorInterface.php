<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Validator;

use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;

interface DefinitionValidatorInterface
{
    public function validate(array $definition): DefinitionValidatorTransfer;
}
