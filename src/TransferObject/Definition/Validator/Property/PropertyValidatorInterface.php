<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorTransfer;

interface PropertyValidatorInterface
{
    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorTransfer;
}
