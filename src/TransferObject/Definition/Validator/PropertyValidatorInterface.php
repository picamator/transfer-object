<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

interface PropertyValidatorInterface
{
    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?string;
}
