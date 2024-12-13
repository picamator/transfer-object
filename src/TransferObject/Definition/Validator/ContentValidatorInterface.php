<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;

interface ContentValidatorInterface
{
    public function validate(DefinitionContentTransfer $contentTransfer): DefinitionValidatorTransfer;
}
