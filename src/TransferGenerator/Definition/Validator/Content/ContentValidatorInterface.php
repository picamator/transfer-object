<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ContentValidatorInterface
{
    public function validate(DefinitionContentTransfer $contentTransfer): ?ValidatorMessageTransfer;
}
