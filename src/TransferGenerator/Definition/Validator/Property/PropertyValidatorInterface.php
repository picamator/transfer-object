<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface PropertyValidatorInterface
{
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool;

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer;
}
