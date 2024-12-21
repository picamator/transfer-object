<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

interface PropertyValidatorInterface
{
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool;

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer;
}
