<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

interface DefinitionValidatorInterface
{
    public function validate(DefinitionContentTransfer $contentTransfer): ValidatorTransfer;
}
