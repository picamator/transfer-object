<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionValidatorTransfer;

interface ContentValidatorInterface
{
    public function validate(DefinitionContentTransfer $contentTransfer): DefinitionValidatorTransfer;
}
